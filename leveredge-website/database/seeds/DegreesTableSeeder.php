<?php

use App\Degree;
use Illuminate\Database\Seeder;

class DegreesTableSeeder extends Seeder
{
    public function run()
    {
        $degrees = [
            Degree::TYPE_UNDERGRADUATE => [
                'Accounting',
                'Agriculture',
                'Allied Health/Medical Admin',
                'Architecture',
                'Biology',
                'Broadcasting, Recording',
                'Business Administration',
                'Business',
                'Chemistry',
                'Communications',
                'Computer Science',
                'Continuing Education',
                'Cosmetology',
                'Criminal Justice',
                'Culinary Arts',
                'Dental Assist/Dental Lab/Med Assist/Pharmacy Tech',
                'Economics',
                'Education',
                'Engineering',
                'English',
                'Film',
                'Fine Arts',
                'Fitness/Exercise',
                'Graphic Design',
                'History',
                'Hospitality',
                'Information Technology',
                'International Rels.',
                'Law and Law Studies',
                'Liberal Arts',
                'Marketing',
                'Mathematics',
                'Mechanics',
                'Medical Billing',
                'Medical',
                'Music',
                'Nursing',
                'Other',
                'Paralegal',
                'Philosophy',
                'Physics',
                'Political Science',
                'Psychology',
                'Sales',
                'Web/Online Student',
            ],
        ];

        foreach ($degrees as $degreeType => $names) {
            array_walk($names, function ($name) use ($degreeType) {
                Degree::query()->updateOrCreate([
                    'name' => $name,
                ], [
                    'type' => $degreeType,
                ]);
            });
        }
    }
}
