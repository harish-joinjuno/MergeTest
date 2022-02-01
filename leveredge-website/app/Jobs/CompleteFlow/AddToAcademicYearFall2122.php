<?php


namespace App\Jobs\CompleteFlow;


use App\AcademicYear;

class AddToAcademicYearFall2122 extends Abstracts\AddToAcademicYear
{

    protected function getAcademicYear()
    {
        return AcademicYear::find(AcademicYear::ACADEMIC_YEAR_FALL_21_AND_BEYOND_ID);
    }
}
