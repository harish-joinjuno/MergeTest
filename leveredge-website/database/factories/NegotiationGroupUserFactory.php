<?php

use App\NegotiationGroupUser;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(NegotiationGroupUser::class, function (Faker $faker) {
    return [
        'status' => $faker->randomElement([
            NegotiationGroupUser::STATUS_APPROVED,
            NegotiationGroupUser::STATUS_DENIED,
            NegotiationGroupUser::STATUS_PENDING,
        ]),
        'amount' => $faker->randomElement([
            10000,
            16000,
            25000,
        ]),
    ];
});
