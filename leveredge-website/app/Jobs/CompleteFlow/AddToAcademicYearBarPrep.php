<?php


namespace App\Jobs\CompleteFlow;


use App\AcademicYear;

class AddToAcademicYearBarPrep extends Abstracts\AddToAcademicYear
{

    protected function getAcademicYear()
    {
        return AcademicYear::find(AcademicYear::ACADEMIC_YEAR_BAR_PREP_ID);
    }
}
