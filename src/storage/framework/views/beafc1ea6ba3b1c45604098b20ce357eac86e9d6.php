<?php $__env->startSection('page-title', 'Login'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container flex justify-center items-center px-4 lg:px-0 py-20">
        <div class="shadow border p-10 w-80" >
            <h1 class="uppercase text-center mb-4 font-bold text-gray-700"><?php echo e(__('Inicia sesión')); ?></h1>
            <div class="">
                <form method="POST" action="<?php echo e(route('login')); ?>">
                    <?php echo csrf_field(); ?>

                    <div class="mb-4">
                        <label for="email" class="block mb-1 text-sm text-gray-500"><?php echo e(__('Correo')); ?></label>
                        <div class="">
                            <input id="email" type="email" class="text-sm w-full outline-none px-2 py-2 border border-gray-300 rounded  <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> text-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus>

                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-red-600 italic" role="alert">
                                    <small><?php echo e($message); ?></small>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="mb-4">

                        <label for="password" class="block mb-1 text-sm text-gray-500"><?php echo e(__('Contraseña')); ?></label>
                        <div class="col-md-6">
                            <input id="password" type="password" class="text-sm w-full outline-none px-2 py-2 border border-gray-300 rounded  <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> text-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required autocomplete="current-password">

                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-red-600 italic" role="alert">
                                    <small><?php echo e($message); ?></small>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="">
                        <div class="">
                            <!--
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" >

                                <label class="form-check-label" for="remember">
                                    
                                </label>
                            </div>-->
                        </div>
                    </div>

                    <div class="">
                        <div class="">
                            <button type="submit" class="py-2 px-4 bg-purple-600 rounded text-white hover:bg-purple-700 w-full">
                                <?php echo e(__('Login')); ?>

                            </button>

                            <?php if(Route::has('password.request')): ?>
                                <a class="" href="<?php echo e(route('password.request')); ?>">
                                    <?php echo e(__('Reestablecer contraseña')); ?>

                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/auth/login.blade.php ENDPATH**/ ?>