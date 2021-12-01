<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\MusicGenre;
use Faker\Generator as Faker;

$factory->define(MusicGenre::class, function (Faker $faker) {
    return [
        'name' => $faker->text,
        'description' => $faker->sentence,
    ];
});
