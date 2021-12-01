<?php

namespace App\Http\Controllers;

use App\Mail\SongContributed as SongContributedMail;
use App\{ MusicGenre, Song, Author};
use App\Http\Requests\{ StoreSong, SongContributed };
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{ Mail, Auth, Log, Storage };

class SongController extends Controller
{

    //Protect this controller with a middleware
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$songs = Song::where('id_writer', Auth::id())->get();
        //$songs = auth()->user()->songs;

        return view('songs.index', [
            "songs" => auth()->user()->songs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('songs.new', [
                    "song" => new Song(),
                    "musicgenres" => MusicGenre::all(),
                    "authors" => Author::all() ]
                );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSong $request)
    {

        $song = new Song([
            'title' => $request->input('title'),
            'lyrics_que' => $request->input('lyrics_que'),
            'lyrics_spn' => $request->input('lyrics_spn'),
            //'lyrics_eng' = $request->input('lyrics_eng'),
            'iframe' => $request->input('iframe'),
            'id_genre' => $request->input('id_genre'),
            'id_author' => $request->input('id_author'),
            'id_writer' => Auth::id(),
        ]);

        //save image
        if($request->file('image')){

            try {

                $song->image = $request->file('image')->store('songs', 's3');

            } catch(Exception $e) {
                return back()->with('status',"ERROR inesperado. Por favor, intente nuevamente");
            }
        }

        $song->save();

        return redirect()
                ->route('dashboard.songs.index')
                ->with('status', 'Canción creado con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {

        $song = Song::where('slug', $slug)->firstOrFail();

        return view('songs.show', [ 'song' => $song ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function edit(Song $song)
    {
        $this->authorize('permit', $song);

        return view('songs.edit', [
                    'song' => $song,
                    "musicgenres" => MusicGenre::all(),
                    "authors" => Author::all()
                ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSong $request, Song $song)
    {
        $this->authorize('permit', $song);

        $song->title = $request->input('title');
        $song->lyrics_que = $request->input('lyrics_que');
        $song->lyrics_spn = $request->input('lyrics_spn');
        $song->iframe = $request->input('iframe');
        $song->id_genre = $request->input('id_genre');
        $song->id_author = $request->input('id_author');
        $song->id_writer = Auth::id();
        $song->save();


        //Update images
        if($request->file('image')){
            Storage::disk('s3')->delete($song->image);

            $song->image = $request->file('image')->store('songs', 's3');
            $song->save();
        }

        return redirect()
                ->route('dashboard.songs.index')
                ->with('status', 'Canción actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function destroy(Song $song)
    {
        $this->authorize('permit', $song);

        $song->delete(); //a observer delete and update image of Song

        return redirect()
                ->route('dashboard.songs.index')
                ->with('status', 'Canción eliminado con éxito.');
    }


    public function contribute(SongContributed $request)
    {

        $song = [
            "title" => $request->input("title"),
            "lyrics_que" => $request->input("lyrics_que"),
            "lyrics_spn" => $request->input("lyrics_spn"),
            "audio_video_url" => $request->input("audio_video_url"),
            "music_genre" => $request->input("music_genre"),
            "author" => $request->input("author"),
            "name_lastname_translater" => $request->input("name_lastname_translater"),
            "email_translater" => $request->input("email_translater"),
            "observation" => $request->input("observation"),
        ];

        try {
            Mail::to( config('app.mail_to_song_contributed') )->send( new SongContributedMail( $song ));
        } catch(Exception $e){
            Log::error($e->getMessage());
        }

        return redirect()
                ->route('song.contribute')
                ->with('status', 'Gracias por contribuir. Revisaré tu subtitulación y traducción, luego te contactaré antes de publicar.');
    }
}
