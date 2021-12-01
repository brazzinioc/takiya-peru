<?php

namespace App\Http\Controllers;

use App\{ Author, MusicGenre };
use App\Http\Requests\StoreAuthor;
use Illuminate\Http\Request;

class AuthorController extends Controller
{

    public function __construct()
    { }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::paginate(5);
        return view('authors.index', [ "authors" => $authors ] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('authors.new', [ "author" => new Author(), "musicgenres" => MusicGenre::all() ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAuthor $request)
    {
        Author::create(
            [
                'name_lastname' => $request->input('name_lastname'),
                'biography' => $request->input('biography'),
                'birth' => $request->input('birth'),
                'facebook' => $request->input('facebook'),
                'youtube' => $request->input('youtube'),
                'instagram' => $request->input('instagram'),
            ]
        );

        return redirect( route('dashboard.authors.index') )
                ->with('status', 'Autor creado con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        return response()->json( $author );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        return view('authors.edit', [ "author" => $author ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAuthor $request, Author $author)
    {
        $author->name_lastname = $request->input('name_lastname');
        $author->biography = $request->input('biography');
        $author->birth = $request->input('birth');
        $author->facebook = $request->input('facebook');
        $author->youtube = $request->input('youtube');
        $author->instagram = $request->input('instagram');
        $author->save();

        return redirect( route('dashboard.authors.index') )
                ->with('status', 'Autor actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        $author->delete();

        return redirect( route('dashboard.authors.index') )
                ->with('status', 'Autor eliminado con éxito.');
    }
}
