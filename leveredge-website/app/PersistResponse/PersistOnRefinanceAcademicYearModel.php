<?php


namespace App\PersistResponse;


use App\AcademicYear;
use App\PersistResponse\Abstracts\AbstractPersistOnNegotiationGroupUser;

class PersistOnRefinanceAcademicYearModel extends AbstractPersistOnNegotiationGroupUser
{

    public function getAcademicYear()
    {
        return AcademicYear::find(AcademicYear::ACADEMIC_YEAR_REFINANCE_ID);
    }
}
