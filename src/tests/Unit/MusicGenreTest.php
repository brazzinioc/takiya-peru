<?php

namespace Tests\Unit;

use App\{ MusicGenre, Song };
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;


class MusicGenreTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * Prueba la existencia de las columnas de la Tabla
     * @return void
     */
    public function test_music_genre_table_has_expected_columns()
    {
        $this->assertTrue( Schema::hasColumns('music_genres', [ 'id', 'name', 'description']) );
    }

    /**
     * Prueba la relación de Género Musical con Canciones.
     *
     * @return void
     */
    public function test_music_genre_has_many_songs()
    {
        $musicGenre = factory(MusicGenre::class)->create();
        $song = factory(Song::class)->create([ 'id_genre' => $musicGenre->id ]);

        //Afirma que en la relación de Género Musical con Canción se encuentre la canción creada.
        $this->assertTrue($musicGenre->songs->contains($song));

        //Afirma que el Género Musical creado Sólo posee un Canción en la colección SONGS.
        $this->assertEquals(1, $musicGenre->songs->count());

        //Afirma que la ralación SONGS sea de tipo Collection
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $musicGenre->songs);
    }
}
