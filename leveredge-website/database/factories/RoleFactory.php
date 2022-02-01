<?php

use App\Role;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(Role::class, function (Faker $faker) {
    return [
        'name'        => $faker->randomElement([
            Role::ROLE_NAME_ADMIN,
            Role::ROLE_NAME_PARTNER,
            Role::ROLE_NAME_LENDER,
            Role::ROLE_NAME_BORROWER,
        ]),
        'description' => $faker->sentence(),
    ];
});
