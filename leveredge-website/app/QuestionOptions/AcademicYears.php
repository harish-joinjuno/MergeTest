<?php


namespace App\QuestionOptions;


use App\AcademicYear;

class AcademicYears implements \App\Contracts\QuestionOptionInterface
{
    public function options()
    {
        return [
            [
                'label'       => 'Right Now',
                'value'       => AcademicYear::ACADEMIC_YEAR_2020_2021_ID,
            ],
            [
                'label'       => 'Winter/Spring 2021',
                'value'       => AcademicYear::ACADEMIC_YEAR_2020_2021_ID,
            ],
            [
                'label'       => 'Summer 2021',
                'value'       => AcademicYear::ACADEMIC_YEAR_2020_2021_ID,
            ],
            [
                'label'       => 'Fall 2021 & beyond',
                'value'       => AcademicYear::ACADEMIC_YEAR_FALL_21_AND_BEYOND_ID,
            ],
        ];
    }
}
