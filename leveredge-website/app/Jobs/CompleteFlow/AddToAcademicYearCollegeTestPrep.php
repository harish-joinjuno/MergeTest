<?php


namespace App\Jobs\CompleteFlow;


use App\AcademicYear;

class AddToAcademicYearCollegeTestPrep extends Abstracts\AddToAcademicYear
{

    protected function getAcademicYear()
    {
        return AcademicYear::find(AcademicYear::ACADEMIC_YEAR_COLLEGE_TEST_PREP_ID);
    }
}
