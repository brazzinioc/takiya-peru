<div class="mb-4">
    <label for="name" class="block mb-1 text-sm text-gray-500">Nombre <span class="text-red-500">*</span></label>
    <input type="text" class="text-sm w-full outline-none px-2 py-2 border border-gray-300 rounded focus:border-purple-700" id="name" name="name" value="<?php if(isset($musicGenre)): ?><?php echo e($musicGenre->name); ?><?php endif; ?><?php echo e(old('name')); ?>" placeholder="Nombre de género musical">
</div>
<div class="mb-4">
    <label for="description" class="block mb-1 text-sm text-gray-500">Descripción<span class="text-red-500">*</span></label>
    <textarea class="text-sm w-full outline-none px-2 py-2 border border-gray-300 rounded focus:border-purple-700" id="description" name="description" rows="3"><?php if(isset($musicGenre)): ?><?php echo e($musicGenre->description); ?><?php endif; ?><?php echo e(old('description')); ?></textarea>
</div>

<small class="block mb-3"><span class="text-red-500">*</span> Campos requeridos</small>
<?php /**PATH /var/www/resources/views/musicGenres/form-fields.blade.php ENDPATH**/ ?>