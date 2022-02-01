<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\FaqGroup;
use Faker\Generator as Faker;

$factory->define(FaqGroup::class, function (Faker $faker) {
    return [
        'name' => $faker->words(3, true),
    ];
});
