@extends('layouts.app')

@section('page-title', 'Canciones')

@section('extra-css')
    <style>
        iframe {
            width: 250px!important;
            height: 200px!important;
        }
    </style>
@endsection


@section('content')
    <div class="container px-4 lg:px-0 py-10">

        <h1 class="uppercase text-center lg:text-left font-semibold">Canciones</h1>

        <div class="py-5 flex justify-end">
            <a class="p-2 lg:p-3 bg-purple-600 rounded text-white hover:bg-purple-700 cursor-pointer" href="{{ route('dashboard.songs.create') }}" role="button">Nuevo</a>
        </div>

        @include('includes.alerts')

        <div class="overflow-x-auto">
            <table class=" border-collapse border border-gray-300 text-xs lg:text-base w-full">
                <thead class="bg-black text-white uppercase  text-center ">
                    <tr>
                        <th class=" font-light p-2 border border-gray-300">N°</th>
                        <th class=" font-light p-2 border border-gray-300">Título</th>
                        <th class=" font-light p-2 border border-gray-300">Género Musical</th>
                        <th class=" font-light p-2 border border-gray-300">Autor</th>
                        <th class=" font-light p-2 border border-gray-300">Imagen y Vídeo</th>
                        <th class=" font-light p-2 border border-gray-300">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    @if($songs && sizeof($songs) > 0)
                        @php $num = 1; @endphp

                        @foreach ($songs as $song)
                            <tr class="hover:bg-purple-100">
                                <th class="p-2 border border-gray-300">{{$num}}</th>
                                <td class="p-2 border border-gray-300">{{$song->title}}</td>
                                <td class="p-2 border border-gray-300">{{$song->genre->name}}</td>
                                <td class="p-2 border border-gray-300">{{$song->author->name_lastname}}</td>
                                <td class="p-2 border border-gray-300">
                                    @isset($song->iframe)
                                        {!!$song->iframe!!}
                                    @endisset

                                    @if(! is_null($song->get_image) )
                                        <a class=" block my-2 text-xs lg:text-base text-blue-700 underline" href="{{env('APP_URL_STATIC')}}/{{$song->get_image}}" alt="{{$song->title}}" target="_blank" title="Ver imagen">Ver imágen</a>
                                    @endif
                                </td>
                                <td class="p-2 border border-gray-300">
                                    <div class="flex flex-wrap lg:flex-nowrap">
                                        <a class="p-1 lg:p-2 bg-green-600 rounded text-white hover:bg-green-700 material-icons block m-auto mb-2 lg:mb-0 lg:mr-2"
                                            id="view-data"
                                            target="_blank"
                                            href="{{ route('song.read', $song->slug) }}"
                                            role="button">
                                            visibility
                                        </a>

                                        <a class="p-1 lg:p-2 bg-yellow-600 rounded text-white hover:bg-yellow-700 material-icons block m-auto mb-2 lg:mb-0 lg:mr-2"
                                            href="{{ route('dashboard.songs.edit', $song) }}"
                                            role="button">
                                            edit
                                        </a>

                                        <form class=" block m-auto" action="{{ route('dashboard.songs.destroy', $song) }}" method="POST" id="form-delete-{{$song->id}}">
                                            @csrf
                                            @method('DELETE')
                                            <a class="p-1 lg:p-2 bg-red-600 rounded text-white hover:bg-red-700 material-icons cursor-pointer"
                                                onclick="let question = confirm('¿Estas segur@ eliminar {{$song->title}}?'); if(question) { document.getElementById('form-delete-{{$song->id}}').submit(); }">delete_outline
                                            </a>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            @php
                                $num += 1;
                            @endphp
                        @endforeach

                    @else
                        <tr>
                            <td colspan="5"> <p class="text-center text-red-500">Aún no has creado ninguna canción.</p> </td>
                        </tr>
                    @endempty
                </tbody>
            </table>
        </div>

    </div>

@endsection


@section('extra-js')

@endsection
