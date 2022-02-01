<?php

use App\NegotiationGroup;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(NegotiationGroup::class, function (Faker $faker) {
    return [
        'name'            => $faker->word,
        'slug'            => $faker->slug,
        'priority'        => $faker->randomElement([
            0,
            1,
            2,
            3,
            4,
            5,
        ]),
        'deal_confidence' => $faker->randomElement([
            10,
            25,
            33,
            50,
            75,
            95,
        ]),
    ];
});
