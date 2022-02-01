<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Experiment;
use Faker\Generator as Faker;

$factory->define(Experiment::class, function (Faker $faker) {
    return [
        'name'               => $faker->word(2, true),
        'experiment_type_id' => $faker->randomDigit,
    ];
});
