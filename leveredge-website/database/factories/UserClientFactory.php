<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\UserClient;
use Faker\Generator as Faker;

$factory->define(UserClient::class, function (Faker $faker) {
    return [
        'user_id'   => factory(\App\User::class)->create()->id,
        'client_id' => 1,
    ];
});
