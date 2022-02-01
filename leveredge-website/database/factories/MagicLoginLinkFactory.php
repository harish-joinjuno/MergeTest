<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\MagicLoginLink;
use Faker\Generator as Faker;

$factory->define(MagicLoginLink::class, function (Faker $faker) {
    return [
        'slug'        => $faker->slug,
        'redirects_to' => url('/'),
    ];
});
