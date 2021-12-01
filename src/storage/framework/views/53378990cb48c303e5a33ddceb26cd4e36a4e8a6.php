<?php $__env->startSection('page-title', $song->title); ?>

<?php $__env->startSection('meta-tags'); ?>
<?php
    $url = config('app.url') . "/songs/{$song->slug}";
    $urlImage = config('app.app_url_static') . "/$song->get_image";
    $description = "{$song->title}, canción en Quechua interpretada por {$song->author->name_lastname}";
?>

<!-- Meta tags -->
<meta name="description" content="<?php echo e($description); ?>">
<meta name="keywords" content="Quechua, canciones en Quechua, Takiya, aprende Quechua gratis, Perú, Perú y Quechua, <?php echo e($song->title); ?>" />
<meta name="author" content="Takiya">
<meta name="copyright" content="Takiya">
<meta name="rating" content="general">

<!-- OPEN GRAPH -->
<meta property="og:type" content="music.song">
<meta property="og:title" content="<?php echo e($song->title); ?>">
<meta property="og:url" content="<?php echo e($url); ?>">
<meta property="og:image" content="<?php echo e($urlImage); ?>"><!--1200x627-->
<meta property="og:description" content="<?php echo e($description); ?>">
<meta property="og:audio" content="<?php echo e($url); ?>">
<meta property="music:musician" content="<?php echo e($song->author->get_facebook); ?>">

<!-- TWITTER CARD -->
<meta name="twitter:card" content="player">
<meta name="twitter:title" content="<?php echo e($song->title); ?>">
<meta name="twitter:site" content="@takiya">
<meta name="twitter:description" content="<?php echo e($description); ?>">
<meta name="twitter:player" content="<?php echo e($url); ?>">
<meta name="twitter:player:height" content="480">
<meta name="twitter:player:width" content="480">
<meta name="twitter:image" content="<?php echo e($urlImage); ?>">
<meta name="twitter:image:alt" content="<?php echo e($song->title); ?>">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('extra-css'); ?>

<style>
    .song-image-cover {
        height: 25rem;
        background-color: black;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
</style>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

    <div class="song-image-cover flex px-4 lg:px-8 py-10" style="background-image: url('<?php echo e($urlImage); ?>')">
        <div class="bg-white text-black p-5 place-self-end w-full lg:w-auto border shadow">
            <h1 class="font-medium text-purple-700 text-2xl mb-1"><?php echo e(strtoupper($song->title)); ?></h1>
            <p class="text-xs lg:text-base">Género musical: <span class="font-semibold"> <?php echo e($song->genre->name); ?>  </p>
            <p class="text-xs lg:text-base">Autor: <span class="font-semibold"> <?php echo e($song->author->name_lastname); ?></p>
            <p class="text-xs lg:text-base">Letras: <span class="font-semibold"> <?php echo e($song->writer->name); ?> </span> </p>
            <p class="text-xs lg:text-base font-light"> <small> Actualización: <span class=""> <?php echo e($song->updated_at->diffForHumans()); ?> </span> </small></p>
        </div>
    </div>

    <div class="container px-4 lg:px-0 py-10">

        <div class="flex flex-col lg:flex-row">

            <div class="">
                <h2 class="uppercase text-center lg:text-left text-purple-700">Letras Quechua</h2>
                <div class="pt-2 pb-5 text-sm lg:text-base lg:pr-10">
                    <?php echo nl2br($song->lyrics_que); ?>
                </div>
            </div>

            <?php if(isset($song->lyrics_spn)): ?>
                <div class="">
                    <h2 class="uppercase text-center lg:text-left text-purple-700">Letras Español</h2>
                    <div class="pt-2 pb-5 text-sm lg:text-base lg:pr-10">
                        <?php echo nl2br($song->lyrics_spn); ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="">
                <h2 class="uppercase text-center lg:text-left  text-purple-700">Vídeo / Audio</h2>
                <div class="pt-2 pb-5">
                    <div class="flex content-center justify-center">
                    <?php if(isset($song->iframe)): ?>
                            <?php echo $song->iframe; ?>

                    <?php else: ?>
                        <p class="text-red-500 text-center">Esta canción no posee Video o Audio.</p>
                    <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('extra-js'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/songs/show.blade.php ENDPATH**/ ?>