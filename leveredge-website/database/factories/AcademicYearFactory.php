<?php

use App\AcademicYear;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(AcademicYear::class, function (Faker $faker) {

    $startsOn = now()->startOfMonth();
    $endsOn   = $startsOn->clone()->addMonths(6);

    return [
        'name'      => $faker->word,
        'starts_on' => $startsOn,
        'ends_on'   => $endsOn,
    ];
});
