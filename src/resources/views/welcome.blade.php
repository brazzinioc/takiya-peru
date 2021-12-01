@extends('layouts.app')


@section('page-title', 'Index')


@section('meta-tags')

@php
    $url = env('APP_URL');
    $description = "Proyecto cuyo objetivo es subtitular en Quechua y traducir al Español canciones interpretados en el idioma Quechua.";
@endphp

<!-- Meta tags -->
<meta name="description" content="{{$description}}">
<meta name="keywords" content="Quechua, canciones en Quechua, Takiya, aprende Quechua gratis, Perú, Perú y Quechua" />
<meta name="author" content="Takiya">
<meta name="copyright" content="Takiya">
<meta name="rating" content="general">

<!--Open Grahp-->
<meta property="og:type" content="website">
<meta property="og:title" content="Index">
<meta property="og:url" content="{{$url}}">
<meta property="og:image" content="https://images.unsplash.com/photo-1511379938547-c1f69419868d?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=870&q=80"> <!--1200x627-->
<meta property="og:description" content="{{$description}}">

<!-- WEBSITE JSON-LD -->
@php

    echo
        "<script type='application/ld+json'>
            {
                '@context': 'http://schema.org/',
                '@type': 'WebSite',
                'url': '$url',
                'potentialAction': {
                    '@type': 'SearchAction',
                    'target': '$url/search?q={search_term_string}',
                    'query-input': 'required name=search_term_string'
                }
            }
        </script>";

@endphp

<!-- TWITTER CARD -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@takiya">
<meta name="twitter:creator" content="@takiya">
<meta name="twitter:title" content="Index">
<meta name="twitter:description" content="{{$description}}">
<meta name="twitter:image" content="https://images.unsplash.com/photo-1549401009-0813d2298165?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80"> <!-- 300x157 -->

@endsection

@section('extra-css')
@endsection


@section('content')


    <div class="container px-4 md:px-0 py-20">
        <div class="flex justify-center items-center">
            <div class="text-center md:text-left">
                <p class="text-gray-700 text-lg mb-2">
                    {{ strtoupper(config('app.name', '')) }}
                    es un proyecto cuyo objetivo es subtitular en Quechua y traducir al Español canciones interpretados en el idioma Quechua.</p>
                <p class="text-gray-700  text-lg italic">Puedes contribuir subtitulando y traduciendo una canción <a class="font-bold" href="{{ route('contribute') }}">aquí</a>.</p>
                <br>
                <a href="#latest-songs" class="p-4 bg-purple-600 rounded text-white hover:bg-purple-700">Ver canciones</a>
            </div>
            <div class="hidden md:block">
                <img src="{{ asset('img/Takiya.svg') }}" class="" alt="{{ config('app.name', '') }}" width="700" height="500" loading="lazy">
            </div>
        </div>
    </div>

    <div class="container px-4 md:px-0 h-screen py-20">
        <main id="latest-songs">

            <h2 class="uppercase font-bold mb-10 text-center md:text-left">Últimas canciones subtituladas</h2>

            @if( isset($songs) && sizeof($songs) > 0)
                <div class="grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-5 lg:gap-4">
                        @if(!empty($songs))
                            @foreach($songs as $song)

                                <div class="mb-6 p-3 lg:mb-0 song-card rounded hover:shadow">
                                    <div class="flex items-center">
                                        <div class="self-baseline">
                                            <a href="{{ route('song.read', $song->slug ) }}" class="block text-xs">
                                                <span class="material-icons play-icon text-purple-700">play_circle_filled</span>
                                            </a>
                                        </div>
                                        <div class="pl-2">
                                            <h2 class="">
                                                <a class="song-title text-gray-500 hover:text-black" href="{{ route('song.read', $song->slug ) }}">
                                                    {{ strtoupper($song->title) }}
                                                </a>
                                            </h2>
                                            <h3 class="text-sm">{{ $song->author->name_lastname }}</h3>
                                            <span class="text-xs bg-green-300 px-2 rounded-lg">{{ $song->genre->name }}</span>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        @endif
                </div>
            @else
                <div class="text-center text-red-500 text-sm" role="alert">
                    Aún no hay canciones publicadas.
                </div>
            @endisset
        </main>
    </div>


@endsection


@section('extra-js')


@endsection
