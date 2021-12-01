@extends('layouts.app')


@section('page-title', 'Contribuir')

@section('meta-tags')

@php
    $url = env('APP_URL') . "/contribuir";
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
<meta property="og:title" content="Contribuir">
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
            }
        </script>";

@endphp

<!-- TWITTER CARD -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@takiya">
<meta name="twitter:creator" content="@takiya">
<meta name="twitter:title" content="Contribuir">
<meta name="twitter:description" content="{{$description}}">
<meta name="twitter:image" content="https://images.unsplash.com/photo-1549401009-0813d2298165?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80"> <!-- 300x157 -->

@endsection

@section('extra-css')
@endsection


@section('content')

    <div class="container px-4 lg:px-0 py-10">
        <h1 class="text-center mb-3">CONTRIBUCIÓN</h1>

        @include('includes.alerts')

        <form action="{{ route('contribute') }}" method="POST" id="form-contribution">
            @csrf

            <div class="mb-4">
                <label for="title" class="block mb-1 text-sm text-gray-500">{{ __('Título de la Canción') }} <span class="text-red-500">*</span></label>
                <input type="text"
                        name="title"
                        class="text-sm w-full outline-none px-2 py-2 border border-gray-300 rounded focus:border-purple-700"
                        value="{{ old('title') }}"
                        placeholder="Ingresa el título de la canción."
                        required>
            </div>

            <div class="mb-4">
                <label for="lyrics_que" class="block mb-1 text-sm text-gray-500">{{ __('Letras en Quechua') }} <span class="text-red-500">*</span></label>
                <textarea class="text-sm w-full outline-none px-2 py-2 border border-gray-300 rounded focus:border-purple-700"
                        id="lyrics_que"
                        name="lyrics_que"
                        rows="15">{{ old('lyrics_que') }}</textarea>
                <small class="text-xs text-gray-500">Por favor ingresa las letras respetando saltos de línea.</small>
            </div>

            <div class="mb-4">
                <label for="lyrics_spn" class="block mb-1 text-sm text-gray-500">{{ __('Letras en Español') }} <span class="text-red-500">*</span> </label>
                <textarea class="text-sm w-full outline-none px-2 py-2 border border-gray-300 rounded focus:border-purple-700"
                            id="lyrics_spn"
                            name="lyrics_spn"
                            rows="15">{{ old('lyrics_spn') }}</textarea>
                <small class="text-xs text-gray-500">Por favor ingresa las letras respetando saltos de línea.</small>
            </div>

            <div class="mb-4">
                <label for="audio_video_url" class="block mb-1 text-sm text-gray-500"> {{ __('URL de Audio / Video') }} <span class="text-red-500">*</span></label>
                <input type="text"
                        name="audio_video_url"
                        class="text-sm w-full outline-none px-2 py-2 border border-gray-300 rounded focus:border-purple-700"
                        value="{{ old('audio_video_url') }}"
                        placeholder="Ingresa URL o Link (Facebook, Youtube, Instagram, Spotify, etc) de la canción."
                        required>
            </div>

            <div class="mb-4">
                <label for="music_genre" class="block mb-1 text-sm text-gray-500"> {{ __('Género musical') }} <span class="text-red-500">*</span></label>
                <input type="text"
                        name="music_genre"
                        class="text-sm w-full outline-none px-2 py-2 border border-gray-300 rounded focus:border-purple-700"
                        value="{{ old('music_genre') }}"
                        placeholder="Ingresa el género musical al que pertenece la canción."
                        required>
            </div>

            <div class="mb-4">
                <label for="author" class="block mb-1 text-sm text-gray-500"> {{ __('Autor') }} <span class="text-red-500">*</span></label>
                <input type="text"
                        name="author"
                        class="text-sm w-full outline-none px-2 py-2 border border-gray-300 rounded focus:border-purple-700"
                        value="{{ old('author') }}"
                        placeholder="Ingresa el nombre del Autor de la canción."
                        required>
            </div>

            <div class="mb-4">
                <label for="name_lastname_translater" class="block mb-1 text-sm text-gray-500"> {{ __('Tu nombre o nickname') }} ( opcional )</label>
                <input type="text"
                        name="name_lastname_translater"
                        class="text-sm w-full outline-none px-2 py-2 border border-gray-300 rounded focus:border-purple-700"
                        value="{{ old('name_lastname_translater') }}"
                        placeholder="Ingresa tu nombre o apodo."
                        >
            </div>

            <div class="mb-4">
                <label for="email_translater" class="block mb-1 text-sm text-gray-500"> {{ __('Tu correo electrónico') }} ( opcional )</label>
                <input type="email"
                        name="email_translater"
                        class="text-sm w-full outline-none px-2 py-2 border border-gray-300 rounded focus:border-purple-700"
                        value="{{ old('email_translater') }}"
                        placeholder="Ingresa tu correo electrónico."
                        >
            </div>

            <div class="mb-4">
                <label for="observation" class="block mb-1 text-sm text-gray-500">{{ __('Observación') }} ( opcional ) </label>
                <textarea class="text-sm w-full outline-none px-2 py-2 border border-gray-300 rounded focus:border-purple-700"
                            id="observation"
                            name="observation"
                            rows="5">{{ old('observation') }}</textarea>
            </div>

            <input type="hidden" id="recaptcha-site-key" value="{{env('GOOGLE_RECAPTCHA_SITE_KEY')}}">
            <input type="hidden" name="recaptcha_token" id="recaptcha-token" value="">
            <small class="mb-4 block"><span class="text-red-500">*</span> Campos obligatorios</small>

            <input type="button" value="Enviar" id="send-contribution" onclick="sendContribution()" class="py-2 px-4 bg-purple-600 rounded text-white hover:bg-purple-700 w-full cursor-pointer">
        </form>
    </div>

@endsection


@section('extra-js')
    <script src="https://www.google.com/recaptcha/api.js?render={{env('GOOGLE_RECAPTCHA_SITE_KEY')}}"></script>
    <script>
        function sendContribution() {
            grecaptcha.ready(function() {
                grecaptcha.execute( document.getElementById('recaptcha-site-key').value, { action: 'submit' } ).then(function(token) {
                    document.getElementById('recaptcha-token').value = token;
                    document.getElementById('form-contribution').submit();
                });
            });
        }
    </script>
@endsection
