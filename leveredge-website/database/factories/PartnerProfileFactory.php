<?php

use App\PartnerProfile;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(PartnerProfile::class, function (Faker $faker) {
    return [
        'user_id'          => $faker->randomDigit,
        'partner_type_id'  => $faker->randomDigit,
        'contract_type_id' => $faker->randomDigit,
    ];
});
