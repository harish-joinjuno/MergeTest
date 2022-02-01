<?php

use App\ContractType;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(ContractType::class, function (Faker $faker) {
    return [
        'type' => $faker->randomElement([
            ContractType::TYPE_CAMPUS_AMBASSADOR,
        ]),
    ];
});
