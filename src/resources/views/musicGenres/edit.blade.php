@extends('layouts.app')

@section('page-title', 'Edición de Género Musical')

@section('extra-css')

@endsection


@section('content')

    <div class="container px-4 lg:px-0 py-10">

        <h1 class="uppercase text-center lg:text-left font-semibold mb-3">Edición de Género Musical</h1>

        @include('includes.alerts')

        <form action="{{ route('dashboard.musicgenres.update', $musicGenre)}}" method="POST" class="my-2">

            @csrf
            @method('PUT')
            @include('musicGenres.form-fields')

            <div class="mt-4">
                <button type="submit" class="py-2 px-4 bg-purple-600 rounded text-white hover:bg-purple-70" >Guardar</button>
                <a class="py-2 px-4 bg-red-600 rounded text-white hover:bg-red-700" href="{{ route('dashboard.musicgenres.index') }}" role="button">Cancelar</a>
            </div>
        </form>

    </div>

@endsection


@section('extra-js')

@endsection
