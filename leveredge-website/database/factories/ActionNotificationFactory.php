<?php


use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use App\ActionNotification;

/** @var Factory $factory */
$factory->define(ActionNotification::class, function (Faker $faker) {
    return [
        'sort_order' => 99,
    ];
});
