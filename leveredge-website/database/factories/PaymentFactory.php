<?php

use App\Payment;
use App\PaymentMethod;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(Payment::class, function (Faker $faker) {
    return [
        'user_id'               => factory(User::class),
        'payer_id'              => factory(User::class),
        'payment_method_id'     => factory(PaymentMethod::class),
        'amount'                => rand(25, 150),
        'status'                => Payment::STATUS_SUBMITTED,
        'reference_information' => [],
    ];
});
