<?php


namespace App\QuestionOptions;


use App\AcademicYear;

class AcademicYearsWithImages implements \App\Contracts\QuestionOptionInterface
{
    public function options()
    {
        return [
            [
                'label'       => 'Right Now',
                'value'       => AcademicYear::ACADEMIC_YEAR_2020_2021_ID,
                'image'       => 'https://via.placeholder.com/150',
            ],
            [
                'label'       => 'Winter/Spring 2021',
                'value'       => AcademicYear::ACADEMIC_YEAR_2020_2021_ID,
                'image'       => 'https://via.placeholder.com/150',
            ],
            [
                'label'       => 'Summer 2021',
                'value'       => AcademicYear::ACADEMIC_YEAR_2020_2021_ID,
                'image'       => 'https://via.placeholder.com/150',
            ],
            [
                'label'       => 'Fall 2021 & beyond',
                'value'       => AcademicYear::ACADEMIC_YEAR_FALL_21_AND_BEYOND_ID,
                'image'       => 'https://via.placeholder.com/150',
            ],
        ];
    }
}
