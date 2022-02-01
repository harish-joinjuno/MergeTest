<?php

use App\UserProfile;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(UserProfile::class, function (Faker $faker) {
    return [
        'immigration_status'     => $faker->randomElement([
            UserProfile::IMMIGRATION_STATUS_US_CITIZEN_OR_PERMANENT_RESIDENT,
            UserProfile::IMMIGRATION_STATUS_US_CONDITIONAL_PERMANENT_RESIDENT,
            UserProfile::IMMIGRATION_STATUS_OTHER,
        ]),
        'graduation_year'        => now()->addYears(2)->year,
        'enrollment_status'      => $faker->randomElement([
            UserProfile::ENROLLMENT_STATUS_FULL_TIME,
            UserProfile::ENROLLMENT_STATUS_HALF_TIME,
            UserProfile::ENROLLMENT_STATUS_PART_TIME,
            UserProfile::ENROLLMENT_STATUS_OTHER,
        ]),
        'degree_format'          => $faker->randomElement([
            UserProfile::DEGREE_FORMAT_ON_CAMPUS,
            UserProfile::DEGREE_FORMAT_ONLINE,
            UserProfile::DEGREE_FORMAT_BLENDED,
            UserProfile::DEGREE_FORMAT_OTHER,
        ]),
        'credit_score'           => $faker->randomElement([
            UserProfile::CREDIT_SCORE_ABOVE_800,
            UserProfile::CREDIT_SCORE_BETWEEN_750_AND_799,
            UserProfile::CREDIT_SCORE_BETWEEN_700_AND_749,
            UserProfile::CREDIT_SCORE_BETWEEN_650_AND_699,
            UserProfile::CREDIT_SCORE_BETWEEN_550_AND_649,
            UserProfile::CREDIT_SCORE_BELOW_550,
            UserProfile::CREDIT_SCORE_I_DONT_HAVE,
            UserProfile::CREDIT_SCORE_UNKNOWN,
        ]),
        'cosigner_status'        => null,
        'cosigner_credit_score'  => null,
        'annual_income'          => null,
        'phone_number'           => null,
        'loan_type'              => null,
        'role'                   => $faker->randomElement([
            UserProfile::ROLE_STUDENT,
            UserProfile::ROLE_PARENT,
        ]),
        'grad_degree_format'     => null,
        'grad_enrollment_status' => null,
        'grad_graduation_year'   => null,
        'grad_degree_id'         => null,
        'grad_university_id'     => null,
        'cosigner_annual_income' => null,
        'loan_amounts'           => null,
        'signup_progress'        => null,
    ];
});
