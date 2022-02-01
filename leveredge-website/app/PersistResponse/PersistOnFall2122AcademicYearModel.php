<?php


namespace App\PersistResponse;


use App\AcademicYear;
use App\PersistResponse\Abstracts\AbstractPersistOnNegotiationGroupUser;

class PersistOnFall2122AcademicYearModel extends AbstractPersistOnNegotiationGroupUser
{

    public function getAcademicYear()
    {
        return AcademicYear::find(AcademicYear::ACADEMIC_YEAR_FALL_21_AND_BEYOND_ID);
    }
}
