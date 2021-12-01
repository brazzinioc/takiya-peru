<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Author;
use App\MusicGenre;
use App\Song;
use App\User;
use Faker\Generator as Faker;

$factory->define(Song::class, function (Faker $faker) {

    $genre = factory(MusicGenre::class)->create();
    $author = factory(Author::class)->create();
    $writer = factory(User::class)->create();

    return [
        'title' => $faker->text,
        'slug' => $faker->slug,
        'lyrics_que' => $faker->paragraph,
        'lyrics_spn' => $faker->paragraph,
        'image' => $faker->imageUrl,
        'iframe' => $faker->text,
        'id_genre' =>  $genre->id,
        'id_author' => $author->id,
        'id_writer' => $writer->id,
    ];
});
