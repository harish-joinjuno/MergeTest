<?php

use App\CampusAmbassadorTask;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(CampusAmbassadorTask::class, function (Faker $faker) {
    return [
        'title'                    => $faker->sentence(),
        'body'                     => $faker->sentence(12, false),
        'task_recurrence'          => $faker->randomElement([
            CampusAmbassadorTask::TASK_RECURRENCE_NONE,
            CampusAmbassadorTask::TASK_RECURRENCE_RECURRING,
        ]),
        'task_completion_tracking' => $faker->randomElement([
            CampusAmbassadorTask::TASK_COMPLETION_TRACKING_AUTOMATIC,
            CampusAmbassadorTask::TASK_COMPLETION_TRACKING_MANUAL,
        ]),
        'payment_type'             => $faker->randomElement([
            CampusAmbassadorTask::PAYMENT_TYPE_FIXED,
            CampusAmbassadorTask::PAYMENT_TYPE_HOURLY,
            CampusAmbassadorTask::PAYMENT_TYPE_NONE,
        ]),
        'fixed_payment_amount'     => $faker->randomElement([
            100,
            200,
            300,
        ]),
        'task_completion_redirect' => null,
    ];
});
