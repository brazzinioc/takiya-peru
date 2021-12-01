<?php $__env->startSection('page-title', 'Nuevo Género Musical'); ?>

<?php $__env->startSection('extra-css'); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

    <div class="container px-4 lg:px-0 py-10">

        <h1 class="uppercase text-center lg:text-left font-semibold mb-3">Nuevo Género Musical</h1>

        <?php echo $__env->make('includes.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <form action="<?php echo e(route('dashboard.musicgenres.store')); ?>" method="POST" class="my-2">

            <?php echo csrf_field(); ?>

            <?php echo $__env->make('musicGenres.form-fields', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="mt-4">
                <button type="submit" class="py-2 px-4 bg-purple-600 rounded text-white hover:bg-purple-700" >Guardar</button>
                <a class="py-2 px-4 bg-red-600 rounded text-white hover:bg-red-700" href="<?php echo e(route('dashboard.musicgenres.index')); ?>" role="button">Cancelar</a>
            </div>

        </form>
    </div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('extra-js'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/musicGenres/new.blade.php ENDPATH**/ ?>