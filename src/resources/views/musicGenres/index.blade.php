@extends('layouts.app')

@section('page-title', 'Géneros musicales')

@section('extra-css')
<script>
    function showData(element){

        let rowId = element.getAttribute('data-row-id') || 0;

        const musicGenreModal = document.getElementById('music-genre-data');
        const musicGenreName = document.getElementById('music-genre-name');
        const musicGenreDescription = document.getElementById('music-genre-description');
        const musicGenreCreatedAt = document.getElementById('music-genre-created-at');
        const musicGenreUpdatedAt = document.getElementById('music-genre-updated-at');


        axios.get(`/dashboard/musicgenres/${rowId}`)
        .then(function (response) {

            if(response.data){

                console.log(response.data)

                musicGenreName.innerText = response.data.name;
                musicGenreDescription.innerText = response.data.description;
                musicGenreCreatedAt.innerText = response.data.created_at.split(' ')[0];
                musicGenreUpdatedAt.innerText = response.data.updated_at.split(' ')[0];

                const modal = document.querySelector('.modal');
                const closeModal = document.querySelectorAll('.close-modal');

                modal.classList.remove('hidden');

                closeModal.forEach(close => {
                    close.addEventListener('click', function (){
                        modal.classList.add('hidden')
                    });
                });

            } else {
                swal("No encontrado!", 'Género musical inactivo.', "info");
            }
        })
        .catch(function (error) {
            swal("Error inesperado!", `${error}`, "error");
        })
        .then(function () {
            // always executed
        });
    }
</script>

@endsection


@section('content')

    <div class="container px-4 lg:px-0 py-10">

        <h1 class="uppercase text-center lg:text-left font-semibold">Género Musical</h1>

        <div class="py-5 flex justify-end">
            <a class="p-2 lg:p-3 bg-purple-600 rounded text-white hover:bg-purple-700 cursor-pointer" href="{{ route('dashboard.musicgenres.create') }}" role="button">Nuevo</a>
        </div>

        @include('includes.alerts')

        <div class="overflow-x-auto">
            <table class="border-collapse border border-gray-300 text-xs lg:text-base w-full">
                <thead class="bg-black text-white uppercase  text-center">
                    <tr>
                        <th class="font-light p-2 border border-gray-300">N°</th>
                        <th class="font-light p-2 border border-gray-300">Nombre</th>
                        <th class="font-light p-2 border border-gray-300">Descripción</th>
                        <th class="font-light p-2 border border-gray-300">Acciones</th>
                    </tr>
                </thead>
                <tbody>


                    @if($musicgenres && sizeof($musicgenres) > 0)
                        @php $num = 1; @endphp

                        @foreach ($musicgenres as $musicgenre)
                            <tr class="hover:bg-purple-100">
                                <th class="p-2 border border-gray-300">{{$num}}</th>
                                <td class="p-2 border border-gray-300">{{$musicgenre->name}}</td>
                                <td class="p-2 border border-gray-300">{{$musicgenre->description}}</td>
                                <td class="p-2 border border-gray-300">
                                    <div class="flex flex-wrap lg:flex-nowrap">

                                        <a class="p-1 lg:p-2 bg-green-600 rounded text-white hover:bg-green-700 material-icons block m-auto mb-2 lg:mb-0 lg:mr-2"
                                            id="view-data"
                                            data-row-id="{{$musicgenre->id}}"
                                            role="button"
                                            onclick="showData(this)">
                                            visibility
                                        </a>

                                        <a class="p-1 lg:p-2 bg-yellow-600 rounded text-white hover:bg-yellow-700 material-icons block m-auto mb-2 lg:mb-0 lg:mr-2"
                                            href="{{route('dashboard.musicgenres.edit', $musicgenre)}}" role="button">
                                            edit
                                        </a>

                                        <form class="block m-auto" action="{{ route('dashboard.musicgenres.destroy', $musicgenre) }}" method="POST" id="form-delete-{{$musicgenre->id}}">
                                            @csrf
                                            @method('DELETE')
                                            <a class="p-1 lg:p-2 bg-red-600 rounded text-white hover:bg-red-700 material-icons cursor-pointer"
                                                onclick="let question = confirm('¿Estas segur@ eliminar {{$musicgenre->name}}?'); if(question) { document.getElementById('form-delete-{{$musicgenre->id}}').submit(); }">
                                                delete_outline
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
                            <td colspan="4"> <p class="text-center text-red-500">Vacío</p></td>
                        </tr>
                    @endempty
                </tbody>
            </table>
        </div>

        @if($musicgenres && sizeof($musicgenres) > 0)
            {{ $musicgenres->links('includes.links') }}
        @endif

    </div>

    @include('musicGenres.modal')

@endsection


@section('extra-js')
@endsection
