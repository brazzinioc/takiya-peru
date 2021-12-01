<?php

namespace Tests\Feature\Http\Controllers;

use App\{ User, Author };
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Contracts\Pagination\Paginator;
use Tests\TestCase;

class AuthorControllerTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    private $prefix = "/dashboard";

    /**
     * Usuarios no autenticados.
     *
     * @return void
     */
    public function test_authors_as_guest()
    {
        //Index
        $this->get("{$this->prefix}/authors")
            ->assertRedirect( route('login') );

        //Create
        $this->get("{$this->prefix}/authors/create")
            ->assertRedirect( route('login') );

        //Store
        $this->post("{$this->prefix}/authors", [])
            ->assertRedirect( route('login') );

        //Show
        $this->get("{$this->prefix}/authors/1")
            ->assertRedirect( route('login') );

        //Edit
        $this->get("{$this->prefix}/authors/1/edit")
            ->assertRedirect( route('login') );

        //Update
        $this->put("{$this->prefix}/authors/1", [])
            ->assertRedirect( route('login') );

        //Destroy
        $this->delete("{$this->prefix}/authors/1")
            ->assertRedirect( route('login') );
    }


    /**
     * Visualización de Lista de Autores | PAGINADOS
     *
     * @return void
     */
    public function test_authors_index()
    {
        //create a user
        $user = factory(User::class)->create();

        //create 150 authors
        factory(Author::class, 150)->create();

        $response = $this->actingAs($user)
                        ->get("{$this->prefix}/authors")
                        ->assertStatus(200);

        $response->assertSee('Next');

        $this->assertInstanceOf( Paginator::class, $response->viewData('authors') );
    }


    /**
     * Visualización de Formulario de Creación
     *
     * @return void
     */
    public function test_authors_create()
    {
        //create a user
        $user = factory(User::class)->create();

        $this
            ->actingAs($user)
            ->get("{$this->prefix}/authors/create")
            ->assertStatus(200);
    }


    /**
     * Almacenamiento de un nuevo Autor
     *
     * @return void
     */
    public function test_authors_store()
    {
        //create a user
        $user = factory(User::class)->create();

        $author = [
            'name_lastname' => $this->faker->firstName . $this->faker->lastName,
            'biography' => $this->faker->text,
            'birth' => $this->faker->date,
            'facebook' => strtolower($this->faker->firstName . $this->faker->lastName),
            'youtube' => strtolower($this->faker->firstName . $this->faker->lastName),
            'instagram' => strtolower($this->faker->firstName . $this->faker->lastName),
        ];

        $this
            ->actingAs($user)
            ->post("{$this->prefix}/authors", $author)
            ->assertRedirect( route('dashboard.authors.index') )
            ->assertSessionHas('status', 'Autor creado con éxito.');

        $this->assertDatabaseHas("authors", $author);
    }


    /**
     * Almacenamiento de un Autor con datos incompletos
     *
     * @return void
     */
    public function test_validate_without_data_author_store()
    {
        //Create a user
        $user = factory(User::class)->create();

        $this
            ->actingAs($user)
            ->post("{$this->prefix}/authors", [ ] )
            ->assertStatus(302) //redirecciona a la misma página
            ->assertSessionHasErrors( [ 'name_lastname' ] );
    }


    /**
     * Almacenamiento de un Autor con datos incorrectos
     *
     * @return void
     */
    public function test_validate_with_data_error_author_store()
    {
        //Create a user
        $user = factory(User::class)->create();

        $author = [
            "name_lastname" => "Na",
            "biography" => "",
            "birth" => "",
            "facebook" => "qwert@89.**",
            "youtube" => "qwert@89.**",
            "instagram" => "qwert@89.**"
        ];

        $this
            ->actingAs($user)
            ->post("{$this->prefix}/authors", $author )
            ->assertStatus(302)
            ->assertSessionHasErrors( [ 'name_lastname', 'facebook', 'youtube', 'instagram' ] );
    }



    /**
     * Visualización de un Género Musical
     *
     * @return void
     */
    public function test_authors_show()
    {
        //create a use
        $user = factory(User::class)->create();

        $author = factory(Author::class)->create();

        $this
            ->actingAs($user)
            ->json('GET', "{$this->prefix}/authors/{$author->id}")
            ->assertJsonStructure( [ 'id', 'name_lastname', 'slug', 'biography', 'birth', 'facebook', 'youtube', 'instagram', 'created_at', 'updated_at', 'deleted_at' ] )
            ->assertJson( [ 'id' => $author->id, 'name_lastname' => $author->name_lastname, 'slug' => $author->slug ]);
    }

    /**
     * Visualización de un Género Musical Inexistente
     *
     * @return void
     */
    public function test_authors_404_show()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->json('GET', "{$this->prefix}/authors/99999999")
            ->assertStatus(404);
    }




    /**
     * Edición de un Autor
     *
     * @return void
     */
    public function test_authors_edit()
    {
        //create a user
        $user = factory(User::class)->create();

        $author = factory(Author::class)->create();

        $this
            ->actingAs($user)
            ->get("{$this->prefix}/authors/{$author->id}/edit")
            ->assertStatus(200)
            ->assertSee($author->id)
            ->assertSee($author->name_lastname);
    }



    /**
     * Actualización de un Autor
     *
     * @return void
     */
    public function test_authors_update()
    {
        //create a user
        $user = factory(User::class)->create();

        $author = factory(Author::class)->create();

        $data = [
            "name_lastname" => "Jhon Doe Ses",
            "biography" => null,
            "birth" => null,
            "facebook" => "jhon_doe",
            "youtube" => "jhon_doe_off",
            "instagram" => "jhon_doe_ses",
        ];

        $this
            ->actingAs($user)
            ->put("{$this->prefix}/authors/{$author->id}", $data)
            ->assertRedirect( route('dashboard.authors.index') )
            ->assertSessionHas('status', 'Autor actualizado con éxito.');

        $this->assertDatabaseHas('authors', $data);
    }



    /**
     * Validación de Actualización de un Autor
     *
     * @return void
     */
    public function test_validate_author_update()
    {
        $user = factory(User::class)->create();

        $author = factory(Author::class)->create();

        $this
            ->actingAs($user)
            ->put("{$this->prefix}/authors/{$author->id}", [ ] )
            ->assertStatus(302)
            ->assertSessionHasErrors(['name_lastname']);
    }



    /**
     * Eliminación de un Autor
     *
     * @return void
     */
    public function test_authors_delete()
    {
        $user = factory(User::class)->create();

        $author = factory(Author::class)->create();

        $this
            ->actingAs($user)
            ->delete("{$this->prefix}/authors/{$author->id}")
            ->assertRedirect( route('dashboard.authors.index') )
            ->assertSessionHas('status', 'Autor eliminado con éxito.');

        $this
            ->assertSoftDeleted('authors', [ "id" => $author->id ]);
    }
}
