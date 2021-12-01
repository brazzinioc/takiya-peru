@extends('layouts.app')

@section('page-title', 'Nueva Canción')

@section('extra-css')

@endsection


@section('content')

    <div class="container px-4 lg:px-0 py-10">

        <h1 class="uppercase text-center lg:text-left font-semibold mb-3">Nueva Canción</h1>

        @include('includes.alerts')

        <form action="{{ route('dashboard.songs.store') }}" method="POST" class="" enctype="multipart/form-data">

            @csrf
            @include('songs.form-fields')

            <div class="mt-4">
                <button type="submit" class="py-2 px-4 bg-purple-600 rounded text-white hover:bg-purple-700" >Guardar</button>
                <a class="py-2 px-4 bg-red-600 rounded text-white hover:bg-red-700" href="{{ route('dashboard.songs.index') }}" role="button">Cancelar</a>
            </div>
        </form>

    </div>

@endsection


@section('extra-js')
@endsection
