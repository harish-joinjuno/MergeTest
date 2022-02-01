<?php

use App\CompletedCampusAmbassadorTask;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(CompletedCampusAmbassadorTask::class, function (Faker $faker) {
    return [
        'amount'            => $faker->randomElement([
            100,
            200,
            300,
        ]),
        'payment_completed' => $faker->boolean(25),
    ];
});
