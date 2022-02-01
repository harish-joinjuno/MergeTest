<?php

use App\NegotiationGroupAnnouncement;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(NegotiationGroupAnnouncement::class, function (Faker $faker) {
    return [
        'title'           => $faker->text,
    ];
});
