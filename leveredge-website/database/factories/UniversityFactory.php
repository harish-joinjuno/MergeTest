<?php

use App\University;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(University::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word . ' University',
    ];
});
