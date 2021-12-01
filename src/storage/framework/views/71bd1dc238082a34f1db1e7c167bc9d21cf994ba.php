<div class="mb-4">
    <label for="name-lastname" class="block mb-1 text-sm text-gray-500"><?php echo e(__('Nombres y apellidos')); ?> <span class="text-red-500">*</span></label>
    <input type="text"
            class="text-sm w-full outline-none px-2 py-2 border border-gray-300 rounded focus:border-purple-700"
            id="name-lastname"
            name="name_lastname"
            value="<?php if(isset($author)): ?><?php echo e($author->name_lastname); ?><?php endif; ?><?php echo e(old('name-lastname')); ?>"
            placeholder="Nombres y apellidos."
            required>
</div>
<div class="mb-4">
    <label for="biography" class="block mb-1 text-sm text-gray-500">Biografía</label>
    <textarea class="text-sm w-full outline-none px-2 py-2 border border-gray-300 rounded focus:border-purple-700"
                id="biography"
                name="biography"
                rows="3"><?php if(isset($author)): ?><?php echo $author->biography; ?><?php endif; ?><?php echo e(old('biography')); ?></textarea>
</div>
<div class="mb-4">
    <label for="birth" class="block mb-1 text-sm text-gray-500">Fecha de Nacimiento</label>
    <input class="text-sm w-full outline-none px-2 py-2 border border-gray-300 rounded focus:border-purple-700"
            type="date"
            id="birth"
            name="birth"
            value="<?php if(isset($author)): ?><?php echo e($author->birth); ?><?php echo e(old('birth')); ?><?php endif; ?>">
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
                value="<?php if(isset($author)): ?><?php echo e($author->facebook); ?><?php endif; ?><?php echo e(old('facebook')); ?>"
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
                value="<?php if(isset($author)): ?><?php echo e("$author->youtube"); ?><?php endif; ?><?php echo e(old('youtube')); ?>"
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
                value="<?php if(isset($author)): ?><?php echo e($author->instagram); ?><?php endif; ?><?php echo e(old('instagram')); ?>"
                placeholder="Nombre de perfil en Instagram. No considere https://instagram.com">
    </div>
</div>

<small class="block mb-3"><span class="text-red-500">*</span> Campos requeridos</small>
<?php /**PATH /var/www/resources/views/authors/form-fields.blade.php ENDPATH**/ ?>