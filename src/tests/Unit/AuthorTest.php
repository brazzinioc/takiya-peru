<?php

namespace Tests\Unit;

use App\Author;
use App\Song;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use \Cviebrock\EloquentSluggable\Services\SlugService;

use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class AuthorTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    private static $facebookUrl = "https://facebook.com/";
    private static $youtubeUrl = "https://youtube.com/channel/";
    private static $instagramUrl = "https://instagram.com/";

    /**
     * Prueba la existencia de las columnas de la Tabla
     *
     * @return void
     */
    public function test_author_table_has_expected_columns()
    {
        $this->assertTrue( Schema::hasColumns('authors', [ 'id', 'name_lastname', 'slug', 'biography', 'birth', 'facebook', 'youtube', 'instagram' ] ) );
    }

    /**
     * Valida la creación de Slug de un Autor
     *
     * @return void
     */
    public function test_author_slug()
    {
        $nameLastname = $this->faker->firstName .  " " . $this->faker->lastName;

        $slug = SlugService::createSlug(Author::class, 'slug', $nameLastname);

        $newAuthor = factory(Author::class)->create([ 'name_lastname' => $nameLastname ]);

        $this
            ->assertDatabaseHas('authors', [ 'slug' => $slug, 'name_lastname' => $nameLastname ])
            ->assertEquals($slug, $newAuthor->slug);
    }


    /*****************************
     * Prueba de ACCESORS
     * ***************************
     */

    /**
     * Prueba accesor de Red Social Facebook
     *
     * @return void
     */
    public function test_get_social_network_facebook()
    {
        $newAuthor = factory(Author::class)->create();

        $this->assertTrue( str_contains($newAuthor->get_facebook, self::$facebookUrl ) );
    }


    /**
     * Prueba accesor de Red Social Youtube
     *
     * @return void
     */
    public function test_get_social_network_youtube()
    {
        $newAuthor = factory(Author::class)->create();

        $this->assertTrue( str_contains($newAuthor->get_youtube, self::$youtubeUrl) );
    }


    /**
     * Prueba accesor de Red Social Instagram
     *
     * @return void
     */
    public function test_get_social_network_instagram()
    {
        $newAuthor = factory(Author::class)->create();

        $this->assertTrue( str_contains($newAuthor->get_instagram, self::$instagramUrl) );
    }


    /*****************************
     * Prueba de RELACIONES
     * ***************************
     */


    /**
     * Prueba la relació de Autor con Canciones
     *
     * @return void
     */
    public function test_author_has_many_songs()
    {
        $author = factory(Author::class)->create();

        $song = factory(Song::class)->create( [ 'id_author' => $author->id ] );

        //Afirma que en la relación de Autor con Canción se encuentre la canción creada.
        $this->assertTrue( $author->songs->contains($song) );

        //Afirma que el Autor creado sólo posee una Canción en la colección SONGS
        $this->assertEquals( 1 , $author->songs->count() );

        //Afirma que la relación SONGS sea de tipo Collection
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $author->songs);
    }








}

