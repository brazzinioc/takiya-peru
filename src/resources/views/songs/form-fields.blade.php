<div class="mb-4">
    <label for="title" class="block mb-1 text-sm text-gray-500">{{ __('Título') }} <span class="text-red-500">*</span></label>
    <input type="text"
            class="text-sm w-full outline-none px-2 py-2 border border-gray-300 rounded focus:border-purple-700"
            id="title"
            name="title"
            value="@isset($song){{$song->title}}@endisset{{old('title')}}"
            placeholder="Título de la canción."
            required>
</div>

<div class="mb-4">
    <label for="lyrics_que" class="block mb-1 text-sm text-gray-500">Letras en Quechua <span class="text-red-500">*</span></label>
    <textarea class="text-sm w-full outline-none px-2 py-2 border border-gray-300 rounded focus:border-purple-700""
            id="lyrics_que"
            name="lyrics_que"
            rows="15">@isset($song){{$song->lyrics_que}}@endisset{{ old('lyrics_que') }}</textarea>
</div>

<div class="mb-4">
    <label for="lyrics_spn" class="block mb-1 text-sm text-gray-500">Letras en Español</label>
    <textarea class="text-sm w-full outline-none px-2 py-2 border border-gray-300 rounded focus:border-purple-700""
                id="lyrics_spn"
                name="lyrics_spn"
                rows="15">@isset($song){{$song->lyrics_spn}}@endisset{{ old('lyrics_spn') }}</textarea>
</div>

<div class="mb-4">
    <label for="image" class="block mb-1 text-sm text-gray-500">Imagen</label>
    <input type="file"
            class="outline-none border border-gray-300 rounded w-full"
            id="image"
            name="image">

    @if( ! is_null($song->image) )
        <div class="py-5">
            <small class="text-red-500 block mb-4">Imagen actual</small>
            <img width="50%" height="50%" src="{{config('app.app_url_static')}}/{{$song->get_image}}" alt="{{$song->title}}">
        </div>
    @endif
</div>

<br>
<div class="mb-4">
    <label for="iframe" class="block mb-1 text-sm text-gray-500">Iframe (video, audio)</label>
    <textarea class="text-sm w-full outline-none px-2 py-2 border border-gray-300 rounded focus:border-purple-700"
                id="iframe"
                name="iframe"
                rows="4">@isset($song){{$song->iframe}}@endisset{{ old('iframe') }}</textarea>

    @isset($song->iframe)
        <br>
        <small class="text-red-500 block">Video actual</small>
        {!!$song->iframe!!}
    @endisset
</div>

<br>
<div class="mb-4">
    <label for="musicgenre" class="block mb-1 text-sm text-gray-500">Género Musical <span class="text-red-500">*</span></label>
    <select class="w-full outline-none px-2 py-2 border border-gray-300 rounded bg-white" aria-label="Music genre select" id="musicgenre" name="id_genre">
        <option selected value="0">-- Seleccione --</option>
        @isset($musicgenres):
            @if(!empty($musicgenres))
                @foreach ($musicgenres as $mg)
                    @if($mg->id === $song->id_genre)
                        <option selected value="{{$mg->id}}">{{$mg->name}}</option>
                    @else
                        <option value="{{$mg->id}}">{{$mg->name}}</option>
                    @endif
                @endforeach
            @endif
        @endisset
    </select>
</div>

<div class="mb-4">
    <label for="author" class="block mb-1 text-sm text-gray-500">Autor <span class="text-red-500">*</span></label>
    <select class="w-full outline-none px-2 py-2 border border-gray-300 rounded bg-white" aria-label="Author select" id="author" name="id_author">
        <option selected value="0">-- Seleccione --</option>
        @isset($authors):
            @if(!empty($authors))
                @foreach ($authors as $a)
                    @if($a->id === $song->id_author)
                        <option selected value="{{$a->id}}">{{$a->name_lastname}}</option>
                    @else
                        <option value="{{$a->id}}">{{$a->name_lastname}}</option>
                    @endif
                @endforeach
            @endif
        @endisset
    </select>
</div>

<small class="d-block mb-3"><span class="text-red-500">*</span> Campos requeridos</small>
