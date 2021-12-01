
<?php if(session('status')): ?>
    <div class="text-green-600 py-5" role="alert">
        <?php echo e(session('status')); ?>

    </div>
<?php endif; ?>


<?php if($errors->any()): ?>
    <div class="py-5" role="alert">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="text-red-500 text-sm"><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>
<?php /**PATH /var/www/resources/views/includes/alerts.blade.php ENDPATH**/ ?>