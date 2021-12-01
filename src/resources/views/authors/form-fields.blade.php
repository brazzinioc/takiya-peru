<div class="mb-4">
    <label for="name-lastname" class="block mb-1 text-sm text-gray-500">{{ __('Nombres y apellidos') }} <span class="text-red-500">*</span></label>
    <input type="text"
            class="text-sm w-full outline-none px-2 py-2 border border-gray-300 rounded focus:border-purple-700"
            id="name-lastname"
            name="name_lastname"
            value="@isset($author){{$author->name_lastname}}@endisset{{old('name-lastname')}}"
            placeholder="Nombres y apellidos."
            required>
</div>
<div class="mb-4">
    <label for="biography" class="block mb-1 text-sm text-gray-500">Biografía</label>
    <textarea class="text-sm w-full outline-none px-2 py-2 border border-gray-300 rounded focus:border-purple-700"
                id="biography"
                name="biography"
                rows="3">@isset($author){!!$author->biography!!}@endisset{{old('biography')}}</textarea>
</div>
<div class="mb-4">
    <label for="birth" class="block mb-1 text-sm text-gray-500">Fecha de Nacimiento</label>
    <input class="text-sm w-full outline-none px-2 py-2 border border-gray-300 rounded focus:border-purple-700"
            type="date"
            id="birth"
            name="birth"
            value="@isset($author){{$author->birth}}{{old('birth')}}@endisset">
</div>
<div class="mb-4">
    <label for="facebook" class="block mb-1 text-sm text-gray-500">Perfil Facebook</label>
    <div class="flex">
        <div class="border-t border-b border-l border-gray-300 p-2 text-sm rounded-tl rounded-bl">
            <span class="text-blue-700">https://facebook.com/</span>
        </div>
        <input type="text"
                class="text-sm w-full outline-none px-2 py-2 border border-gray-300 rounded-tr rounded-br focus:border-purple-700"
                id="facebook"
                name="facebook"
                value="@isset($author){{$author->facebook}}@endisset{{old('facebook')}}"
                placeholder="Nombre de perfil en Facebook. No considere https://facebook.com/">
    </div>

</div>
<div class="mb-4">
    <label for="youtube" class="block mb-1 text-sm text-gray-500">Perfil Youtube</label>
    <div class="flex">
        <div class="border-t border-b border-l border-gray-300 p-2 text-sm rounded-tl rounded-bl">
            <span class="text-blue-700">https://youtube.com/</span>
        </div>
        <input type="text"
                class="text-sm w-full outline-none px-2 py-2 border border-gray-300 rounded-tr rounded-br focus:border-purple-700"
                id="youtube"
                name="youtube"
                value="@isset($author){{"$author->youtube"}}@endisset{{old('youtube')}}"
                placeholder="Nombre de perfil en Youtube. No considere https://youtube.com/">
    </div>

</div>
<div class="mb-4">
    <label for="instagram" class="block mb-1 text-sm text-gray-500">Instagram</label>
    <div class="flex">
        <div class="border-t border-b border-l border-gray-300 p-2 text-sm rounded-tl rounded-bl">
            <div class="text-blue-700">https://instagram.com/</div>
        </div>
        <input type="text"
                class="text-sm w-full outline-none px-2 py-2 border border-gray-300 rounded-tr rounded-br focus:border-purple-700"
                id="instagram"
                name="instagram"
                value="@isset($author){{$author->instagram}}@endisset{{old('instagram')}}"
                placeholder="Nombre de perfil en Instagram. No considere https://instagram.com">
    </div>
</div>

<small class="block mb-3"><span class="text-red-500">*</span> Campos requeridos</small>
