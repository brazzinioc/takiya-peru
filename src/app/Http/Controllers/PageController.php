<?php

namespace App\Http\Controllers;

use App\Song;
use Illuminate\Http\Request;

class PageController extends Controller
{

    /**
     * Muestra página principal de la Aplicación.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home(Request $request)
    {
        return view('welcome', [
            'songs' => Song::latest()->limit(10)->get()
            ]);
    }

    /**
     * Muestra página de Contribución
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function contribute()
    {
        return view('contribute');
    }


}
