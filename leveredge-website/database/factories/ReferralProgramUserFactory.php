<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ReferralProgramUser;
use Faker\Generator as Faker;

$factory->define(ReferralProgramUser::class, function (Faker $faker) {
    return [
        'referral_program_id' => $faker->randomDigit,
        'user_id'             => $faker->randomDigit,
        'starts_on'           => now(),
    ];
});
