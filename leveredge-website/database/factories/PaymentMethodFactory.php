<?php

use App\PaymentMethod;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(PaymentMethod::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement([
            PaymentMethod::PAYMENT_METHOD_DIGITAL_CHECK,
            PaymentMethod::PAYMENT_METHOD_AMAZON_GIFT_CARD,
        ]),
    ];
});
