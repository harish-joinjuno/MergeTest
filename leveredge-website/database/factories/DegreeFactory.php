<?php

use App\Degree;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(Degree::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word,
        'type' => $faker->randomElement([
            Degree::TYPE_GRADUATE,
            Degree::TYPE_UNDERGRADUATE,
        ]),
    ];
});
