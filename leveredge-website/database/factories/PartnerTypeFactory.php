<?php

use App\PartnerType;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(PartnerType::class, function (Faker $faker) {
    return [
        'type' => $faker->randomElement([
            PartnerType::TYPE_CAMPUS_AMBASSADOR,
        ]),
    ];
});
