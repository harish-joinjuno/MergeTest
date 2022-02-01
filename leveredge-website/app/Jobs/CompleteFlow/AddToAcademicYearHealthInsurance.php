<?php


namespace App\Jobs\CompleteFlow;


use App\AcademicYear;

class AddToAcademicYearHealthInsurance extends Abstracts\AddToAcademicYear
{

    protected function getAcademicYear()
    {
        return AcademicYear::find(AcademicYear::ACADEMIC_YEAR_HEALTH_INSURANCE_ID);
    }
}
