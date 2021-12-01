@extends('layouts.app')

@section('page-title', 'Edición de Autor')

@section('extra-css')

@endsection


@section('content')

    <div class="container px-4 lg:px-0 py-10">

        <h1 class="uppercase text-center lg:text-left font-semibold mb-3">Edición de Autor</h1>

        @include('includes.alerts')

        <form action="{{ route('dashboard.authors.update', $author) }}" method="POST" class="my-2">
            @csrf
            @method('PUT')
            @include('authors.form-fields')

            <div class="mt-4">
                <button type="submit" class="py-2 px-4 bg-purple-600 rounded text-white hover:bg-purple-70" >Guardar</button>
                <a class="py-2 px-4 bg-red-600 rounded text-white hover:bg-red-700" href="{{ route('dashboard.authors.index') }}" role="button">Cancelar</a>
            </div>
        </form>
    </div>

@endsection


@section('extra-js')

@endsection
