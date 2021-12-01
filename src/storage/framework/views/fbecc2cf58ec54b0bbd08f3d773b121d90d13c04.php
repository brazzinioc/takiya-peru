<div class="mb-4">
    <label for="title" class="block mb-1 text-sm text-gray-500"><?php echo e(__('Título')); ?> <span class="text-red-500">*</span></label>
    <input type="text"
            class="text-sm w-full outline-none px-2 py-2 border border-gray-300 rounded focus:border-purple-700"
            id="title"
            name="title"
            value="<?php if(isset($song)): ?><?php echo e($song->title); ?><?php endif; ?><?php echo e(old('title')); ?>"
            placeholder="Título de la canción."
            required>
</div>

<div class="mb-4">
    <label for="lyrics_que" class="block mb-1 text-sm text-gray-500">Letras en Quechua <span class="text-red-500">*</span></label>
    <textarea class="text-sm w-full outline-none px-2 py-2 border border-gray-300 rounded focus:border-purple-700""
            id="lyrics_que"
            name="lyrics_que"
            rows="15"><?php if(isset($song)): ?><?php echo e($song->lyrics_que); ?><?php endif; ?><?php echo e(old('lyrics_que')); ?></textarea>
</div>

<div class="mb-4">
    <label for="lyrics_spn" class="block mb-1 text-sm text-gray-500">Letras en Español</label>
    <textarea class="text-sm w-full outline-none px-2 py-2 border border-gray-300 rounded focus:border-purple-700""
                id="lyrics_spn"
                name="lyrics_spn"
                rows="15"><?php if(isset($song)): ?><?php echo e($song->lyrics_spn); ?><?php endif; ?><?php echo e(old('lyrics_spn')); ?></textarea>
</div>

<div class="mb-4">
    <label for="image" class="block mb-1 text-sm text-gray-500">Imagen</label>
    <input type="file"
            class="outline-none border border-gray-300 rounded w-full"
            id="image"
            name="image">

    <?php if( ! is_null($song->image) ): ?>
        <div class="py-5">
            <small class="text-red-500 block mb-4">Imagen actual</small>
            <img width="50%" height="50%" src="<?php echo e(env('APP_URL_STATIC')); ?>/<?php echo e($song->get_image); ?>" alt="<?php echo e($song->title); ?>">
        </div>
    <?php endif; ?>
</div>

<br>
<div class="mb-4">
    <label for="iframe" class="block mb-1 text-sm text-gray-500">Iframe (video, audio)</label>
    <textarea class="text-sm w-full outline-none px-2 py-2 border border-gray-300 rounded focus:border-purple-700"
                id="iframe"
                name="iframe"
                rows="4"><?php if(isset($song)): ?><?php echo e($song->iframe); ?><?php endif; ?><?php echo e(old('iframe')); ?></textarea>

    <?php if(isset($song->iframe)): ?>
        <br>
        <small class="text-red-500 block">Video actual</small>
        <?php echo $song->iframe; ?>

    <?php endif; ?>
</div>

<br>
<div class="mb-4">
    <label for="musicgenre" class="block mb-1 text-sm text-gray-500">Género Musical <span class="text-red-500">*</span></label>
    <select class="w-full outline-none px-2 py-2 border border-gray-300 rounded bg-white" aria-label="Music genre select" id="musicgenre" name="id_genre">
        <option selected value="0">-- Seleccione --</option>
        <?php if(isset($musicgenres)): ?>:
            <?php if(!empty($musicgenres)): ?>
                <?php $__currentLoopData = $musicgenres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($mg->id === $song->id_genre): ?>
                        <option selected value="<?php echo e($mg->id); ?>"><?php echo e($mg->name); ?></option>
                    <?php else: ?>
                        <option value="<?php echo e($mg->id); ?>"><?php echo e($mg->name); ?></option>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        <?php endif; ?>
    </select>
</div>

<div class="mb-4">
    <label for="author" class="block mb-1 text-sm text-gray-500">Autor <span class="text-red-500">*</span></label>
    <select class="w-full outline-none px-2 py-2 border border-gray-300 rounded bg-white" aria-label="Author select" id="author" name="id_author">
        <option selected value="0">-- Seleccione --</option>
        <?php if(isset($authors)): ?>:
            <?php if(!empty($authors)): ?>
                <?php $__currentLoopData = $authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($a->id === $song->id_author): ?>
                        <option selected value="<?php echo e($a->id); ?>"><?php echo e($a->name_lastname); ?></option>
                    <?php else: ?>
                        <option value="<?php echo e($a->id); ?>"><?php echo e($a->name_lastname); ?></option>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        <?php endif; ?>
    </select>
</div>

<small class="d-block mb-3"><span class="text-red-500">*</span> Campos requeridos</small>
<?php /**PATH /var/www/resources/views/songs/form-fields.blade.php ENDPATH**/ ?>