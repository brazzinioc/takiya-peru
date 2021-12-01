<?php

namespace App\Http\Controllers;

use App\MusicGenre;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMusicGenre;

class MusicGenreController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $musicGenres = MusicGenre::paginate(10);

        return view('musicGenres.index', [ "musicgenres" => $musicGenres ] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('musicGenres.new', [ "musicgenre" => new MusicGenre() ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMusicGenre $request)
    {

        MusicGenre::create(
            [
                'name' => $request->input('name'),
                'description' => $request->input('description')
            ]
        );

        return redirect( route('dashboard.musicgenres.index') )
                ->with('status', 'Género musical creado con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(MusicGenre $musicgenre)
    {
        return response()->json( $musicgenre );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(MusicGenre $musicgenre)
    {
        return view('musicGenres.edit', [ 'musicGenre' => $musicgenre ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreMusicGenre $request, MusicGenre $musicgenre)
    {
        $musicgenre->name = $request->input('name');
        $musicgenre->description = $request->input('description');
        $musicgenre->save();

        return redirect( route('dashboard.musicgenres.index') )
                ->with('status', 'Género musical actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MusicGenre $musicgenre)
    {
        $musicgenre->delete();

        return redirect( route('dashboard.musicgenres.index') )
                ->with('status', 'Género musical eliminado con éxito.');
    }
}
