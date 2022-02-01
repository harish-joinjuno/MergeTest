<?php

use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Str;

/** @var Factory $factory */
$factory->define(User::class, function (Faker $faker) {
    $firstName = $faker->firstName;
    $lastName  = $faker->lastName;

    return [
        'name'           => "{$firstName} {$lastName}",
        'first_name'     => $firstName,
        'last_name'      => $lastName,
        'email'          => $faker->unique()->safeEmail,
        'password'       => bcrypt('secret'),
        'remember_token' => Str::random(10),
        'referral_code'  => Str::random(8),
    ];
});
