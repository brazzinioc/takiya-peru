<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Author;
use Faker\Generator as Faker;

$factory->define(Author::class, function (Faker $faker) {
    return [
        'name_lastname' => $faker->firstName . $faker->lastName,
        'slug' => $faker->slug,
        'biography' => $faker->text,
        'birth' => $faker->date,
        'facebook' => strtolower($faker->firstName . $faker->lastName),
        'youtube' => strtolower($faker->firstName . $faker->lastName),
        'instagram' => strtolower($faker->firstName . $faker->lastName),
    ];
});
