<?php

namespace Tests\Unit;

use App\{ User, MusicGenre, Song, Author };
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Tests\TestCase;

class SongTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * Prueba la existencia de las columnas de la Tabla
     * @return void
     */
    public function test_song_table_has_expected_columns()
    {
        $this
            ->assertTrue( Schema::hasColumns('songs', [ 'id', 'title', 'slug', 'lyrics_que', 'lyrics_spn', 'lyrics_eng', 'image', 'iframe', 'id_genre', 'id_author', 'id_writer']) );
    }

    /**
     * Valida la creación de Slug de una Canción
     *
     * @return void
     */
    public function test_song_slug()
    {
        $songTitle = $this->faker->text;

        $slug = SlugService::createSlug(Song::class, 'slug', $songTitle);
        $newSong = factory(Song::class)->create( ['title' => $songTitle, 'slug' => $slug ] );

        $this
            ->assertDatabaseHas('songs', [ 'slug' => $slug, 'title' => $songTitle ])
            ->assertEquals($slug, $newSong->slug);
    }

    /**
     * Prueba la Accesor de Imagen de una Canción
     *
     * @return void
     */
    public function test_song_get_image_without_img()
    {
        $song = factory(Song::class)->create( [ 'image' => null ] );

        $this->assertEquals("songs/Takiya.webp", $song->get_image);
    }


    /**
     * Prueba la Accesor de Imagen de una Canción
     *
     * @return void
     */
    public function test_song_get_image_with_img()
    {
        $hash = md5('file-name');
        $imageJpg = "songs/{$hash}.jpg";
        $imageWebp = "songs/{$hash}.webp";

        $song = factory(Song::class)->create( [ 'image' => $imageJpg ] );

        $this->assertEquals($imageWebp, $song->get_image);
    }




    /**
     * Prueba la relación de Canción con Género Musical
     * @return void
     */
    public function test_song_belongs_to_music_genre()
    {
        $newSong = factory(Song::class)->create();
        $this->assertInstanceOf(MusicGenre::class, $newSong->genre);
    }

    /**
     * Prueba la relación de Canción con Autor
     * @return void
     */
    public function test_song_belongs_to_author()
    {
        $newSong = factory(Song::class)->create();
        $this->assertInstanceOf(Author::class, $newSong->author);
    }

    /**
     * Prueba la relación de Canción con Escritor (traductor)
     * @return void
     */
    public function test_song_belongs_to_writer()
    {
        $newSong = factory(Song::class)->create();
        $this->assertInstanceOf(User::class, $newSong->writer);
    }
}


