@extends('layouts.app')

@section('page-title', 'Autores')

@section('extra-css')
<script>

    function showData(element){

        let rowId = element.getAttribute('data-row-id') || 0;

        axios.get(`/dashboard/authors/${rowId}`)
        .then(function (response) {

            if(response.data){

                const authorNameLastname = document.getElementById('author-name-lastname');
                const authorBiography = document.getElementById('author-biography');
                const authorBirth = document.getElementById('author-birth');
                const authorFacebook = document.getElementById('author-facebook');
                const authorYoutube = document.getElementById('author-youtube');
                const authorInstagram = document.getElementById('author-instagram');
                const authorCreatedAt = document.getElementById('author-created-at');
                const authorUpdatedAt = document.getElementById('author-updated-at');

                authorNameLastname.innerText = response.data.name_lastname || '';
                authorBiography.innerHTML = response.data.biography || '';
                authorBirth.innerText = response.data.birth || '';
                authorFacebook.setAttribute('href', `https://facebook.com/${response.data.facebook}` || 'https://facebook.com');
                authorYoutube.setAttribute('href', `https://youtube.com/channel/${response.data.youtube}` || 'https://youtube.com/');
                authorInstagram.setAttribute('href', `https://instagram.com/${response.data.instagram}` || 'https://instagram.com/');
                authorCreatedAt.innerText = response.data.created_at.split(' ')[0] || '';
                authorUpdatedAt.innerText = response.data.updated_at.split(' ')[0] || '';

                const modal = document.querySelector('.modal');
                const closeModal = document.querySelectorAll('.close-modal');

                modal.classList.remove('hidden');

                closeModal.forEach(close => {
                    close.addEventListener('click', function (){
                        modal.classList.add('hidden')
                    });
                });

            } else {
                swal("No encuentro!", 'Autor inactivo.', "info");
            }
        })
        .catch(function (error) {
            // handle error
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

        <h1 class="uppercase text-center lg:text-left font-semibold">Autores</h1>

        <div class="py-5 flex justify-end">
            <a class="p-2 lg:p-3 bg-purple-600 rounded text-white hover:bg-purple-700 cursor-pointer" href="{{ route('dashboard.authors.create') }}" role="button">Nuevo</a>
        </div>

        @include('includes.alerts')

        <div class="overflow-x-auto">
            <table class=" border-collapse border border-gray-300 text-xs lg:text-base w-full">
                <thead class="bg-black text-white uppercase  text-center">
                    <tr>
                        <th class=" font-light p-2 border border-gray-300">N??</th>
                        <th class=" font-light p-2 border border-gray-300">Nombres & Apellidos</th>
                        <th class=" font-light p-2 border border-gray-300">Biograf??a</th>
                        <th class=" font-light p-2 border border-gray-300">Redes Sociales</th>
                        <th class=" font-light p-2 border border-gray-300">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    @if($authors && sizeof($authors) > 0)
                        @php $num = 1; @endphp

                        @foreach ($authors as $author)
                            <tr class="hover:bg-purple-100">
                                <th class="p-2 border border-gray-300">{{$num}}</th>
                                <td class="p-2 border border-gray-300">{{$author->name_lastname}}</td>
                                <td class="p-2 border border-gray-300">{!!$author->biography!!}</td>
                                <td class="p-2 border border-gray-300">
                                    <ul>
                                        <li><a class="text-blue-700 text-xs underline" target="_blank" href="{{$author->get_facebook}}">Facebook</a></li>
                                        <li><a class="text-blue-700 text-xs underline" target="_blank" href="{{$author->get_youtube}}">Youtube</a></li>
                                        <li><a class="text-blue-700 text-xs underline" target="_blank" href="{{$author->get_instagram}}">Instagram</a></li>
                                    </ul>
                                </td>
                                <td class="p-2 border border-gray-300">

                                    <div class="flex flex-wrap lg:flex-nowrap">

                                        <a class="p-1 lg:p-2 bg-green-600 rounded text-white hover:bg-green-700 material-icons block m-auto mb-2 lg:mb-0 lg:mr-2"
                                            id="view-data"
                                            data-row-id="{{$author->id}}"
                                            role="button"
                                            onclick="showData(this)">
                                            visibility
                                        </a>

                                        <a class="p-1 lg:p-2 bg-yellow-600 rounded text-white hover:bg-yellow-700 material-icons block m-auto mb-2 lg:mb-0 lg:mr-2"
                                            href="{{route('dashboard.authors.edit', $author)}}"
                                            role="button">
                                            edit
                                        </a>

                                        <form class="block m-auto" action="{{ route('dashboard.authors.destroy', $author) }}" method="POST" id="form-delete-{{$author->id}}">
                                            @csrf
                                            @method('DELETE')
                                            <a class="p-1 lg:p-2 bg-red-600 rounded text-white hover:bg-red-700 material-icons cursor-pointer"
                                                onclick="let question = confirm('??Estas segur@ eliminar {{$author->name_lastname}}?'); if(question) { document.getElementById('form-delete-{{$author->id}}').submit(); }">
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
                            <td colspan="5"> <p class="text-center text-red-500">Vac??o</p> </td>
                        </tr>
                    @endempty
                </tbody>
            </table>
        </div>


        @if($authors && sizeof($authors) > 0)
            {{ $authors->links('includes.links') }}
        @endif

    </div>

    @include('authors.modal')

@endsection


@section('extra-js')
@endsection
