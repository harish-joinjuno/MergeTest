<?php


namespace App\Jobs\CompleteFlow;


use App\AcademicYear;

class AddToAcademicYearRefinance extends Abstracts\AddToAcademicYear
{

    protected function getAcademicYear()
    {
        return AcademicYear::find(AcademicYear::ACADEMIC_YEAR_REFINANCE_ID);
    }
}
