<?php

namespace Tests\Feature\Http\Controllers;

use App\{ Author, MusicGenre, Song, User };
use App\Mail\{ SongContributed };
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\{ Auth, Mail };
use Tests\TestCase;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class SongControllerTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    private $prefix = "/dashboard";

    /**
     * Usuarios no autenticados
     *
     * @return void
     */
    public function test_songs_as_guest()
    {
        //Index
        $this->get("{$this->prefix}/songs")
            ->assertRedirect(route('login'));

        //Create
        $this->get("{$this->prefix}/songs/create")
            ->assertRedirect(route('login'));

        //Store
        $this->post("{$this->prefix}/songs", [])
            ->assertRedirect(route('login'));

        //Edit
        $this->get("{$this->prefix}/songs/1/edit")
            ->assertRedirect(route('login'));

        //Update
        $this->put("{$this->prefix}/songs/1")
            ->assertRedirect(route('login'));

        //Destroy
        $this->delete("{$this->prefix}/songs/1")
            ->assertRedirect(route('login'));
    }


    /**
     * Visualización de una Canción
     * @return void
     */
    public function test_show_a_song()
    {
        //Create a song
        $song = factory(Song::class)->create();

        //Show
        $this->get("/songs/{$song->slug}")
            ->assertStatus(200)
            ->assertSee("{$song->title}")
            ->assertSee("{$song->genre->name}")
            ->assertSee("{$song->author->name_lastname}");
    }

    /**
     * Visualización de una Canción no existente.
     *
     * @return void
     */
    public function test_show_a_song_no_exist()
    {
        //creata a song
        $song = factory(Song::class)->create();

        $slugFake = "mi-primera-cancion";

        //Show
        $this->get("/songs/$slugFake")
        ->assertStatus(404);
    }

    /**
     * Visualización de Canciones creados por cada usuario.
     * @return void
     */
    public function test_songs_index_empty()
    {
        //Create a Song
        factory(Song::class)->create(); //With id_writer = 1

        $user = factory(User::class)->create(); //Here id == 2

        $this
            ->actingAs($user)
            ->get("{$this->prefix}/songs")
            ->assertStatus(200)
            ->assertSee('Aún no has creado ninguna canción.');
    }


    /**
     * Visualización de Canciones creados por cada usuario.
     * @return void
     */
    public function test_songs_index_with_data()
    {
        //Create a user
        $user = factory(User::class)->create(); //id == 1
        $song = factory(Song::class)->create(['id_writer' => $user->id ]); //create a song with id_writter == 1

        $this
            ->actingAs($user)
            ->get("{$this->prefix}/songs")
            ->assertStatus(200)
            ->assertSee($song->title)
            //->assertSee($song->image)
            ->assertSee($song->genre->name)
            ->assertSee($song->author->name_lastname);
    }


    /**
     * Visualización de Formulario de Creación
     * @return void
     */
    public function test_songs_create()
    {
        //create a User
        $user = factory(User::class)->create();

        //create a Music Genre
        $musicGenre = factory(MusicGenre::class)->create();

        //create a Author
        $author = factory(Author::class)->create();

        $this
            ->actingAs($user)
            ->get("{$this->prefix}/songs/create")
            ->assertStatus(200)
            ->assertSee($musicGenre->id)
            ->assertSee($musicGenre->name)
            ->assertSee($author->id)
            ->assertSee($author->name_lastname);
    }


    /**
     * Almacenamiento de una nueva Canción.
     * @return void
     */
    public function test_songs_store()
    {
        $this->withExceptionHandling();

        //create a User
        $user = factory(User::class)->create();

        //create a Music Genre
        $musicGenre = factory(MusicGenre::class)->create();

        //create a Author
        $author = factory(Author::class)->create();

        //Configura entorno Fake donde se subirá el archivo.
        Storage::fake('s3');

        $image = UploadedFile::fake()->image('music-image.jpg');

        $newSong = [
            'title' => $this->faker->text,
            'lyrics_que' => $this->faker->paragraph,
            'lyrics_spn' => $this->faker->paragraph,
            'image' => $image,
            'iframe' => $this->faker->text,
            'id_genre' => $musicGenre->id,
            'id_author' => $author->id,
            'id_writer' => $user->id
        ];

        $this
            ->actingAs($user)
            ->post("{$this->prefix}/songs", $newSong)
            ->assertStatus(302)
            ->assertRedirect(route("dashboard.songs.index"))
            ->assertSessionHas('status', 'Canción creado con éxito.');

        Storage::disk('s3')->assertExists("songs/{$image->hashName()}");

        $newSong['image'] = "songs/{$image->hashName()}";

        $this->assertDatabaseHas('songs', $newSong);
    }


    /**
     * Almacenamiento de una Canción con datos incompletos
     * @return void
     */
    public function test_validate_songs_store()
    {
        $this->withExceptionHandling();

        $user = factory(User::class)->create();

        $this
            ->actingAs($user)
            ->post("{$this->prefix}/songs", [])
            ->assertStatus(302)
            ->assertSessionHasErrors(['title', 'lyrics_que', 'id_genre', 'id_author']);
    }


    /**
     * Edición de una canción.
     * @return void
     */
    public function test_songs_edit()
    {
        $this->withExceptionHandling();

        $user = factory(User::class)->create();
        $musicGenre = factory(MusicGenre::class)->create();
        $author = factory(Author::class)->create();

        $newSong = factory(Song::class)->create( ['id_writer' => $user->id] );

        $this
            ->actingAs($user)
            ->get("{$this->prefix}/songs/{$newSong->id}/edit")
            ->assertStatus(200)
            ->assertSee($newSong->id)
            ->assertSee($newSong->title)
            ->assertSee($musicGenre->id)
            ->assertSee($musicGenre->name)
            ->assertSee($author->id)
            ->assertSee($author->name_lastname);
    }


    /**
     * Actualización de una Canción
     * @return void
     */
    public function test_songs_update()
    {
        $this->withExceptionHandling();

        Storage::fake('s3');

        $user = factory(User::class)->create();

        $newSong = factory(Song::class)->create(['id_writer' => $user->id]);

        $image = UploadedFile::fake()->image('music-image.jpg');

        $data = [
            'title' => $this->faker->text,
            'lyrics_que' => $this->faker->paragraph,
            'lyrics_spn' => $this->faker->paragraph,
            'iframe' => $this->faker->text,
            'image' => $image,
            'id_genre' => $newSong->id_genre,
            'id_author' => $newSong->id_author,
        ];

        $this
            ->actingAs($user)
            ->put("{$this->prefix}/songs/{$newSong->id}", $data)
            ->assertStatus(302)
            ->assertRedirect( route('dashboard.songs.index') )
            ->assertSessionHas('status', 'Canción actualizado con éxito.');

        Storage::disk('s3')->assertExists("songs/{$image->hashName()}");

        $data['image'] = "songs/{$image->hashName()}"; //actualiza ruta más el Hash

        $this->assertDatabaseHas('songs', $data);
    }

    /**
     * Actualización de una Canción
     * @return void
     */
    public function test_validate_songs_update(){
        $this->withExceptionHandling();

        $user = factory(User::class)->create();

        $newSong = factory(Song::class)->create([ 'id_writer' => $user->id ]);

        $this
            ->actingAs($user)
            ->put("{$this->prefix}/songs/{$newSong->id}", [])
            ->assertStatus(302)
            ->assertSessionHasErrors(['title', 'lyrics_que', 'id_genre', 'id_author']);
    }


    /**
     * Eliminación de una Canción
     * @return void
     */
    public function test_songs_delete()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $newSong = factory(Song::class)->create([ 'id_writer' => $user->id, 'image' => null]);

        $this
            ->actingAs($user)
            ->delete("{$this->prefix}/songs/{$newSong->id}")
            ->assertStatus(302)
            ->assertRedirect( route('dashboard.songs.index') )
            ->assertSessionHas('status', 'Canción eliminado con éxito.');

        $this->assertSoftDeleted('songs', [ 'id' => $newSong->id ] );
    }




    /**********************************************
     * Policies
     * ********************************************/

    /**
     * Validación de Política en Edición de una canción
     * @return void
     */
    public function test_songs_edit_policy()
    {
        $user = factory(User::class)->create(); //User with id=1

        $newSong = factory(Song::class)->create(); //Create a song with id_writer=2.

        $this
            ->actingAs($user)
            ->get("{$this->prefix}/songs/{$newSong->id}/edit")
            ->assertStatus(403);
    }


    /**
     * Validación de Política en Actualización de una Canción
     * @return void
     */
    public function test_songs_update_policy()
    {
        $user = factory(User::class)->create(); //User with id=1

        $newSong = factory(Song::class)->create(); //Create a song with id_writer=2

        $data = [
            'title' => $this->faker->text,
            'lyrics_que' => $this->faker->paragraph,
            'lyrics_spn' => $this->faker->paragraph,
            'iframe' => $this->faker->text,
            'id_genre' => $newSong->id_genre,
            'id_author' => $newSong->id_author,
        ];

        $this
            ->actingAs($user)
            ->put("{$this->prefix}/songs/{$newSong->id}", $data)
            ->assertStatus(403);
    }

    /**
     * Validación de Política en Eliminación de una Canción
     * @return void
     */
    public function test_songs_delete_policy()
    {
        $user = factory(User::class)->create(); //User with id=1

        $newSong = factory(Song::class)->create(); //Create a song with id_writer=2

        $this
            ->actingAs($user)
            ->delete("{$this->prefix}/songs/{$newSong->id}")
            ->assertStatus(403);
    }



    /**
     * Contribución de una Canción
     *
     * @return void
     */
    public function test_song_contribution()
    {
        Mail::fake();

        Mail::assertNothingSent();

        $songContributed = [
            "title" => $this->faker->text, //required
            "lyrics_que" => $this->faker->text(1000), //required
            "lyrics_spn" => $this->faker->text(1000), //required
            "audio_video_url" => $this->faker->url, //required
            "music_genre" => $this->faker->text, //required
            "author" => $this->faker->name . " " . $this->faker->lastName, //required
            "name_lastname_translater" => $this->faker->text,
            "email_translater" => $this->faker->email,
            "observation" => $this->faker->text(500),
            "recaptcha_token" => $this->faker->text(100),
        ];

        $this->post( route("song.contribute"), $songContributed )
            ->assertStatus(302)
            ->assertRedirect( route('song.contribute') )
            ->assertSessionHas('status', 'Gracias por contribuir. Revisaré tu subtitulación y traducción, luego te contactaré antes de publicar.');


        Mail::assertSent(SongContributed::class);
    }
}
