<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', '') }} | @yield('page-title') </title>

    @yield('meta-tags')

    <!-- Global site tag (gtag.js) - Google Analytics -->
    @php
        $googleAnalytics = env('GOOGLE_ANALYTICS');

        echo "<script async src='https://www.googletagmanager.com/gtag/js?id={{$googleAnalytics}}'></script>";
        echo "<script>
                window.dataLayer = window.dataLayer || [];
                function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());

                gtag('config', '$googleAnalytics');
            </script>";
    @endphp

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!--<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">-->

    <!-- Google Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('extra-css')
</head>
<body class="font-opsans">
    <div id="app">
        <nav class="shadow p-4">
            <div class="container flex justify-between content-center flex-col lg:flex-row">
                <div class="mb-3 lg:mb-0 text-center lg:text-left">
                    <a class="font-semibold uppercase tracking-widest text-lg" href="{{ url('/') }}">
                        {{ config('app.name', '') }}
                    </a>
                </div>

                <div class="" id="navbarSupportedContent">

                    <!-- Right Side Of Navbar -->
                    <ul class="flex font-medium text-xs lg:text-base flex-wrap lg:flex-nowrap">
                        <!-- Authentication Links -->
                        <li class="mr-4">
                            <a class="text-gray-500 hover:text-black" href="{{ route('home') }}">
                                {{ __('Inicio') }}
                            </a>
                        </li>

                        <li class="mr-4">
                            <a class="text-gray-500 hover:text-black" href="{{ route('contribute') }}">
                                {{ __('Contribuir') }}
                            </a>
                        </li>

                        @guest

                            <li class="">
                                <a class="py-2 px-4 bg-purple-600 rounded text-white hover:bg-purple-700" href="{{ route('login') }}">
                                    {{ __('Ingresar') }}
                                </a>
                            </li>



                            @if (Route::has('register'))
                                <!--
                                <li class="mr-4">
                                    <a class="" href="{{-- route('register') --}}">
                                        {{-- __('Registrarse') --}}
                                    </a>
                                </li>-->
                            @endif

                        @else


                            {{-- Nav options app --}}
                            <li class="mr-4">
                                <a class="text-gray-500 hover:text-black" href="{{ route('dashboard.songs.index') }}">
                                    {{ __('Canciones') }}
                                </a>
                            </li>

                            <li class="mr-4">
                                <a class="text-gray-500 hover:text-black" href="{{ route('dashboard.authors.index') }}">
                                    {{ __('Autores') }}
                                </a>
                            </li>

                            <li class="mr-4">
                                <a class="text-gray-500 hover:text-black" href="{{ route('dashboard.musicgenres.index') }}">
                                    {{ __('Géneros Musicales') }}
                                </a>
                            </li>

                            <a class="text-purple-700 inline-flex justify-center" href="#" id="profile-button" onclick="(document.getElementById('profile-options').classList.contains('hidden')) ? document.getElementById('profile-options').classList.remove('hidden') :  document.getElementById('profile-options').classList.add('hidden');  " aria-expanded="true" aria-haspopup="true">
                                {{ ucfirst(Auth::user()->name) }}
                                <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </a>


                            <div class="hidden origin-top-right absolute right-0 mt-10 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1" id="profile-options">
                                <div class="py-1" role="none">
                                    <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                                    <a href="#" class="text-gray-500 block px-4 py-2 text-sm hover:text-black" role="menuitem" tabindex="-1" id="menu-item-0">Perfil</a>
                                    <a href="#" class="text-gray-500 block px-4 py-2 text-sm hover:text-black" role="menuitem" tabindex="-1" id="menu-item-1">Soporte</a>
                                    <form method="POST" action="{{ route('logout') }}" role="none">
                                        @csrf
                                        <button type="submit" class="font-medium text-gray-500 hover:text-black block w-full text-left px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-3">
                                            {{ __('Salir') }}
                                        </button>
                                    </form>
                                </div>
                            </div>

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="">
            @yield('content')
        </div>
    </div>
    <footer class="bg-black py-5">
        <p class="text-white text-xs text-center">Hecho por <a class="text-indigo-600" rel="noopener" target="_blank" href="https://brazzinioc.com">Brazzini OC</a> con 💪 y 💚</p>
    </footer>
    @yield('extra-js')
</body>
</html>
