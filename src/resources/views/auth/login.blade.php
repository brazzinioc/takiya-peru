@extends('layouts.app')

@section('page-title', 'Login')

@section('content')
    <div class="container flex justify-center items-center px-4 lg:px-0 py-20">
        <div class="shadow border p-10 w-80" >
            <h1 class="uppercase text-center mb-4 font-bold text-gray-700">{{ __('Inicia sesión') }}</h1>
            <div class="">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="block mb-1 text-sm text-gray-500">{{ __('Correo') }}</label>
                        <div class="">
                            <input id="email" type="email" class="text-sm w-full outline-none px-2 py-2 border border-gray-300 rounded  @error('email') text-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="text-red-600 italic" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">

                        <label for="password" class="block mb-1 text-sm text-gray-500">{{ __('Contraseña') }}</label>
                        <div class="col-md-6">
                            <input id="password" type="password" class="text-sm w-full outline-none px-2 py-2 border border-gray-300 rounded  @error('password') text-red-500 @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="text-red-600 italic" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="">
                        <div class="">
                            <!--
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{-- old('remember') ? 'checked' : '' --}}>

                                <label class="form-check-label" for="remember">
                                    {{-- __('Remember Me') --}}
                                </label>
                            </div>-->
                        </div>
                    </div>

                    <div class="">
                        <div class="">
                            <button type="submit" class="py-2 px-4 bg-purple-600 rounded text-white hover:bg-purple-700 w-full">
                                {{ __('Login') }}
                            </button>

                            @if (Route::has('password.request'))
                                <a class="" href="{{ route('password.request') }}">
                                    {{ __('Reestablecer contraseña') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
