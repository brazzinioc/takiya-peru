<?php

namespace Tests\Feature\Http\Controllers;

use App\ { MusicGenre, User };
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Contracts\Pagination\Paginator;
use Tests\TestCase;

class MusicGenreControllerTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    private $prefix = "/dashboard";

    /**
     * Usuarios no autenticados
     * @return void
     */
    public function test_music_genres_as_guest()
    {
        //Index
        $this->get("{$this->prefix}/musicgenres")
            ->assertRedirect( route('login') );

        //Create
        $this->get("{$this->prefix}/musicgenres/create")
            ->assertRedirect( route('login') );

        //Store
        $this->post("{$this->prefix}/musicgenres", [])
            ->assertRedirect( route('login') );

        //Show
        $this->get("{$this->prefix}/musicgenres/1")
            ->assertRedirect( route('login') );

        //Edit
        $this->get("{$this->prefix}/musicgenres/1/edit")
            ->assertRedirect( route('login') );

        //Update
        $this->put("{$this->prefix}/musicgenres/1", [])
            ->assertRedirect( route('login') );

        //Destroy
        $this->delete("{$this->prefix}/musicgenres/1")
            ->assertRedirect( route('login') );
    }


    /**
     * Visualización de Lista de Géneros Musicales | PAGINADOS
     *
     * @return void
     */
    public function test_music_genres_index()
    {
        //create a user
        $user = factory(User::class)->create();

        //create 150 rows
        factory(MusicGenre::class, 150)->create();

        $response = $this->actingAs($user)
                        ->get("{$this->prefix}/musicgenres")
                        ->assertStatus(200);

        $response->assertSee('Next');

        $this->assertInstanceOf(Paginator::class, $response->viewData('musicgenres'));
    }

    /**
     * Visualización de Formulario de Creación
     * @return void
     */
    public function test_music_genres_create()
    {
        //Create a user
        $user = factory(User::class)->create();

        $this
            ->actingAs($user)
            ->get("{$this->prefix}/musicgenres/create")
            ->assertStatus(200);
    }



    /**
     * Almacenamiento de un nuevo Género Musical
     * @return void
     */
    public function test_music_genres_store()
    {
        //create a user
        $user = factory(User::class)->create();

        $newMusicGenre = [
            "name" => $this->faker->text(20),
            "description" => $this->faker->text(150)
        ];

        $this
            ->actingAs($user)
            ->post("{$this->prefix}/musicgenres", $newMusicGenre)
            ->assertRedirect( route('dashboard.musicgenres.index') )
            ->assertSessionHas('status', 'Género musical creado con éxito.');

        $this->assertDatabaseHas( "music_genres", $newMusicGenre );
    }


    /**
     * Almacenamiento de un Género Musical con datos incompletos
     * @return void
     */
    public function test_validate_1_music_genres_store()
    {
        $user = factory(User::class)->create();

        $this
            ->actingAs($user)
            ->post("{$this->prefix}/musicgenres", [])
            ->assertStatus(302) //redirección a la misma página
            ->assertSessionHasErrors(['name', 'description']);
    }

    /**
     * Almacenamiento de un Género Musical con datos incompletos
     * @return void
     */
    public function test_validate_2_music_genres_store()
    {
        $user = factory(User::class)->create();

        $newMusicGenre = [
            "name" => "tit",
            "description" => $this->faker->text(8)
        ];

        $this
            ->actingAs($user)
            ->post("{$this->prefix}/musicgenres", $newMusicGenre)
            ->assertStatus(302) //redirección a la misma página
            ->assertSessionHasErrors(['name', 'description']);
    }



    /**
     * Visualización de un Género Musical
     *
     * @return void
     */
    public function test_music_genres_show()
    {
        //create a use
        $user = factory(User::class)->create();

        $newMusicGenre = factory(MusicGenre::class)->create();

        $this
            ->actingAs($user)
            ->json('GET', "{$this->prefix}/musicgenres/{$newMusicGenre->id}")
            ->assertJsonStructure( [ 'id', 'name', 'description', 'created_at', 'updated_at', 'deleted_at' ] )
            ->assertJson( [ 'name' => $newMusicGenre->name, 'description' => $newMusicGenre->description ]);
    }

    /**
     * Visualización de un Género Musical Inexistente
     *
     * @return void
     */
    public function test_music_genres_404_show()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->json('GET', "{$this->prefix}/musicgenres/99999999")
            ->assertStatus(404);
    }



    /**
     * Edición de un Género Musical
     * @return void
     */
    public function test_music_genres_edit()
    {
        $this->withExceptionHandling();

        //create a user
        $user = factory(User::class)->create();

        $newMusicGenre = factory(MusicGenre::class)->create();

        $this
            ->actingAs($user)
            ->get("{$this->prefix}/musicgenres/{$newMusicGenre->id}/edit")
            ->assertStatus(200)
            ->assertSee($newMusicGenre->id)
            ->assertSee($newMusicGenre->description);
    }



    /**
     * Actualización de un Género Musical
     * @return void
     */
    public function test_music_genres_update()
    {
        $this->withoutExceptionHandling();

        //create a user
        $user = factory(User::class)->create();

        $newMusicGenre = factory(MusicGenre::class)->create();

        $data = [
            "name" => $this->faker->text(25),
            "description" => $this->faker->text(50),
        ];

        $this
            ->actingAs($user)
            ->put("{$this->prefix}/musicgenres/{$newMusicGenre->id}", $data)
            ->assertRedirect( route('dashboard.musicgenres.index') )
            ->assertSessionHas('status', 'Género musical actualizado con éxito.');

        $this->assertDatabaseHas("music_genres", $data);
    }



    /**
     * Validación en Actualización de un Género Musical
     * @return void
     */
    public function test_validate_music_genres_update()
    {
        $this->withExceptionHandling();

        $user = factory(User::class)->create();

        $newMusicGenre = factory(MusicGenre::class)->create();

        $this
            ->actingAs($user)
            ->put("{$this->prefix}/musicgenres/{$newMusicGenre->id}", [])
            ->assertStatus(302)
            ->assertSessionHasErrors(['name', 'description']);
    }


    /**
     * Eliminación de un Género Musical
     * @return void
     */
    public function test_music_genres_delete()
    {
        $user = factory(User::class)->create();

        $newMusicGenre = factory(MusicGenre::class)->create();

        $this
            ->actingAs($user)
            ->delete("{$this->prefix}/musicgenres/{$newMusicGenre->id}")
            ->assertRedirect( route('dashboard.musicgenres.index') )
            ->assertSessionHas('status', 'Género musical eliminado con éxito.');

        $this->assertSoftDeleted('music_genres', [ 'id' => $newMusicGenre->id ]);
    }

}



