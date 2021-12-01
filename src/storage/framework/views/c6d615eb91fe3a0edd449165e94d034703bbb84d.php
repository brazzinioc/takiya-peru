<?php $__env->startSection('page-title', 'Index'); ?>


<?php $__env->startSection('meta-tags'); ?>

<?php
    $url = config('app.url');
    $description = "Proyecto cuyo objetivo es subtitular en Quechua y traducir al Español canciones interpretados en el idioma Quechua.";
?>

<!-- Meta tags -->
<meta name="description" content="<?php echo e($description); ?>">
<meta name="keywords" content="Quechua, canciones en Quechua, Takiya, aprende Quechua gratis, Perú, Perú y Quechua" />
<meta name="author" content="Takiya">
<meta name="copyright" content="Takiya">
<meta name="rating" content="general">

<!--Open Grahp-->
<meta property="og:type" content="website">
<meta property="og:title" content="Index">
<meta property="og:url" content="<?php echo e($url); ?>">
<meta property="og:image" content="https://images.unsplash.com/photo-1511379938547-c1f69419868d?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=870&q=80"> <!--1200x627-->
<meta property="og:description" content="<?php echo e($description); ?>">

<!-- WEBSITE JSON-LD -->
<?php

    echo
        "<script type='application/ld+json'>
            {
                '@context': 'http://schema.org/',
                '@type': 'WebSite',
                'url': '$url',
                'potentialAction': {
                    '@type': 'SearchAction',
                    'target': '$url/search?q={search_term_string}',
                    'query-input': 'required name=search_term_string'
                }
            }
        </script>";

?>

<!-- TWITTER CARD -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@takiya">
<meta name="twitter:creator" content="@takiya">
<meta name="twitter:title" content="Index">
<meta name="twitter:description" content="<?php echo e($description); ?>">
<meta name="twitter:image" content="https://images.unsplash.com/photo-1549401009-0813d2298165?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80"> <!-- 300x157 -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('extra-css'); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

    <div class="container px-4 md:px-0 py-20">
        <div class="flex justify-center items-center">
            <div class="text-center md:text-left">
                <p class="text-gray-700 text-lg mb-2">
                    <?php echo e(strtoupper(config('app.name', ''))); ?>

                    es un proyecto cuyo objetivo es subtitular en Quechua y traducir al Español canciones interpretados en el idioma Quechua.</p>
                <p class="text-gray-700  text-lg italic">Puedes contribuir subtitulando y traduciendo una canción <a class="font-bold" href="<?php echo e(route('contribute')); ?>">aquí</a>.</p>
                <br>
                <a href="#latest-songs" class="p-4 bg-purple-600 rounded text-white hover:bg-purple-700">Ver canciones</a>
            </div>
            <div class="hidden md:block">
                <img src="<?php echo e(asset('img/Takiya.svg')); ?>" class="" alt="<?php echo e(config('app.name', '')); ?>" width="700" height="500" loading="lazy">
            </div>
        </div>
    </div>

    <div class="container px-4 md:px-0 h-screen py-20">
        <main id="latest-songs" class="">

            <h2 class="uppercase font-bold mb-10 text-center md:text-left">Últimas canciones subtituladas</h2>

            <?php if( isset($songs) && sizeof($songs) > 0): ?>
                <div class="grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-5 lg:gap-4">
                        <?php if(!empty($songs)): ?>
                            <?php $__currentLoopData = $songs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $song): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <div class="mb-6 p-3 lg:mb-0 song-card rounded hover:shadow">
                                    <div class="flex items-center">
                                        <div class="self-baseline">
                                            <a href="<?php echo e(route('song.read', $song->slug )); ?>" class="block text-xs">
                                                <span class="material-icons play-icon text-purple-700">play_circle_filled</span>
                                            </a>
                                        </div>
                                        <div class="pl-2">
                                            <h2 class="">
                                                <a class="song-title text-gray-500 hover:text-black" href="<?php echo e(route('song.read', $song->slug )); ?>">
                                                    <?php echo e(strtoupper($song->title)); ?>

                                                </a>
                                            </h2>
                                            <h3 class="text-sm"><?php echo e($song->author->name_lastname); ?></h3>
                                            <span class="text-xs bg-green-300 px-2 rounded-lg"><?php echo e($song->genre->name); ?></span>
                                        </div>
                                    </div>
                                </div>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="text-center text-indigo-700 text-sm md:text-left bg-gray-200 p-2" role="alert">
                    Aún no hay canciones publicadas.
                </div>
            <?php endif; ?>
        </main>
    </div>


<?php $__env->stopSection(); ?>


<?php $__env->startSection('extra-js'); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/welcome.blade.php ENDPATH**/ ?>