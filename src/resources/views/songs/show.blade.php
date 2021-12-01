@extends('layouts.app')

@section('page-title', $song->title)

@section('meta-tags')
@php
    $url = config('app.url') . "/songs/{$song->slug}";
    $urlImage = config('app.app_url_static') . "/$song->get_image";
    $description = "{$song->title}, canción en Quechua interpretada por {$song->author->name_lastname}";
@endphp

<!-- Meta tags -->
<meta name="description" content="{{$description}}">
<meta name="keywords" content="Quechua, canciones en Quechua, Takiya, aprende Quechua gratis, Perú, Perú y Quechua, {{$song->title}}" />
<meta name="author" content="Takiya">
<meta name="copyright" content="Takiya">
<meta name="rating" content="general">

<!-- OPEN GRAPH -->
<meta property="og:type" content="music.song">
<meta property="og:title" content="{{$song->title}}">
<meta property="og:url" content="{{$url}}">
<meta property="og:image" content="{{$urlImage}}"><!--1200x627-->
<meta property="og:description" content="{{$description}}">
<meta property="og:audio" content="{{$url}}">
<meta property="music:musician" content="{{$song->author->get_facebook}}">

<!-- TWITTER CARD -->
<meta name="twitter:card" content="player">
<meta name="twitter:title" content="{{$song->title}}">
<meta name="twitter:site" content="@takiya">
<meta name="twitter:description" content="{{$description}}">
<meta name="twitter:player" content="{{$url}}">
<meta name="twitter:player:height" content="480">
<meta name="twitter:player:width" content="480">
<meta name="twitter:image" content="{{$urlImage}}">
<meta name="twitter:image:alt" content="{{$song->title}}">

@endsection

@section('extra-css')

<style>
    .song-image-cover {
        height: 25rem;
        background-color: black;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
</style>

@endsection


@section('content')

    <div class="song-image-cover flex px-4 lg:px-8 py-10" style="background-image: url('{{$urlImage}}')">
        <div class="bg-white text-black p-5 place-self-end w-full lg:w-auto border shadow">
            <h1 class="font-medium text-purple-700 mb-1">{{strtoupper($song->title)}}</h1>
            <p class="text-xs lg:text-base">Género musical: <span class="font-semibold"> {{ $song->genre->name }}  </p>
            <p class="text-xs lg:text-base">Autor: <span class="font-semibold"> {{ $song->author->name_lastname }}</p>
            <p class="text-xs lg:text-base">Letras: <span class="font-semibold"> {{ $song->writer->name }} </span> </p>
            <p class="text-xs lg:text-base font-light">Actualización: <span class=""> {{ $song->updated_at->diffForHumans() }} </span> </p>
        </div>
    </div>

    <div class="container px-4 lg:px-0 py-10">

        <div class="flex flex-col lg:flex-row">

            <div class="">
                <h2 class="uppercase text-center lg:text-left text-purple-700">Letras Quechua</h2>
                <div class="pt-2 pb-5 text-sm lg:text-base lg:pr-10">
                    @php echo nl2br($song->lyrics_que); @endphp
                </div>
            </div>

            @isset($song->lyrics_spn)
                <div class="">
                    <h2 class="uppercase text-center lg:text-left text-purple-700">Letras Español</h2>
                    <div class="pt-2 pb-5 text-sm lg:text-base lg:pr-10">
                        @php echo nl2br($song->lyrics_spn); @endphp
                    </div>
                </div>
            @endisset

            <div class="">
                <h2 class="uppercase text-center lg:text-left  text-purple-700">Vídeo / Audio</h2>
                <div class="pt-2 pb-5">
                    <div class="flex content-center justify-center">
                    @isset($song->iframe)
                            {!!$song->iframe!!}
                    @else
                        <p class="text-red-500 text-center">Esta canción no posee Video o Audio.</p>
                    @endisset
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection


@section('extra-js')

@endsection
