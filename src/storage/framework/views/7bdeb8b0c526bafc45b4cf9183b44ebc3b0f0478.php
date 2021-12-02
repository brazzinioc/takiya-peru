<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(config('app.name', '')); ?> | <?php echo $__env->yieldContent('page-title'); ?> </title>

    <?php echo $__env->yieldContent('meta-tags'); ?>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <?php
        $googleAnalytics = config('app.google_analytics_id');

        echo "<script async src='https://www.googletagmanager.com/gtag/js?id={{$googleAnalytics}}'></script>";
        echo "<script>
                window.dataLayer = window.dataLayer || [];
                function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());

                gtag('config', '$googleAnalytics');
            </script>";
    ?>

    <!-- Scripts -->
    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!--<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">-->

    <!-- Google Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">

    <?php echo $__env->yieldContent('extra-css'); ?>
</head>
<body class="font-opsans">
    <div id="app">
        <nav class="shadow p-4">
            <div class="container flex justify-between content-center flex-col lg:flex-row">
                <div class="mb-3 lg:mb-0 text-center lg:text-left">
                    <a class="font-semibold uppercase tracking-widest text-lg" href="<?php echo e(url('/')); ?>">
                        <?php echo e(config('app.name', '')); ?>

                    </a>
                    <span class="bg-green-300 px-1 py-0 rounded text-xs font-normal">Beta</span>
                </div>

                <div class="" id="navbarSupportedContent">

                    <!-- Right Side Of Navbar -->
                    <ul class="flex font-medium text-xs lg:text-base flex-wrap lg:flex-nowrap">
                        <!-- Authentication Links -->
                        <li class="mr-4">
                            <a class="text-gray-500 hover:text-black" href="<?php echo e(route('home')); ?>">
                                <?php echo e(__('Inicio')); ?>

                            </a>
                        </li>

                        <li class="mr-4">
                            <a class="text-gray-500 hover:text-black" href="<?php echo e(route('contribute')); ?>">
                                <?php echo e(__('Contribuir')); ?>

                            </a>
                        </li>

                        <?php if(auth()->guard()->guest()): ?>

                            <li class="">
                                <a class="py-2 px-4 bg-purple-600 rounded text-white hover:bg-purple-700" href="<?php echo e(route('login')); ?>">
                                    <?php echo e(__('Ingresar')); ?>

                                </a>
                            </li>



                            <?php if(Route::has('register')): ?>
                                <!--
                                <li class="mr-4">
                                    <a class="" href="">
                                        
                                    </a>
                                </li>-->
                            <?php endif; ?>

                        <?php else: ?>


                            
                            <li class="mr-4">
                                <a class="text-gray-500 hover:text-black" href="<?php echo e(route('dashboard.songs.index')); ?>">
                                    <?php echo e(__('Canciones')); ?>

                                </a>
                            </li>

                            <li class="mr-4">
                                <a class="text-gray-500 hover:text-black" href="<?php echo e(route('dashboard.authors.index')); ?>">
                                    <?php echo e(__('Autores')); ?>

                                </a>
                            </li>

                            <li class="mr-4">
                                <a class="text-gray-500 hover:text-black" href="<?php echo e(route('dashboard.musicgenres.index')); ?>">
                                    <?php echo e(__('Géneros Musicales')); ?>

                                </a>
                            </li>

                            <a class="text-purple-700 inline-flex justify-center" href="#" id="profile-button" onclick="(document.getElementById('profile-options').classList.contains('hidden')) ? document.getElementById('profile-options').classList.remove('hidden') :  document.getElementById('profile-options').classList.add('hidden');  " aria-expanded="true" aria-haspopup="true">
                                <?php echo e(ucfirst(Auth::user()->name)); ?>

                                <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </a>


                            <div class="hidden origin-top-right absolute right-0 mt-10 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1" id="profile-options">
                                <div class="py-1" role="none">
                                    <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                                    <a href="#" class="text-gray-500 block px-4 py-2 text-sm hover:text-black" role="menuitem" tabindex="-1" id="menu-item-0">Perfil</a>
                                    <a href="#" class="text-gray-500 block px-4 py-2 text-sm hover:text-black" role="menuitem" tabindex="-1" id="menu-item-1">Soporte</a>
                                    <form method="POST" action="<?php echo e(route('logout')); ?>" role="none">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="font-medium text-gray-500 hover:text-black block w-full text-left px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-3">
                                            <?php echo e(__('Salir')); ?>

                                        </button>
                                    </form>
                                </div>
                            </div>

                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>
    <footer class="bg-black py-5">
        <p class="text-white text-xs text-center">Hecho por <a class="text-indigo-600" rel="noopener" target="_blank" href="https://brazzinioc.com">Brazzini OC</a> con 💪 y 💚</p>
    </footer>
    <?php echo $__env->yieldContent('extra-js'); ?>
</body>
</html>
<?php /**PATH /var/www/resources/views/layouts/app.blade.php ENDPATH**/ ?>