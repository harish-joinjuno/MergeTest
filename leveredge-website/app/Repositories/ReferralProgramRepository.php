<?php


namespace App\Repositories;


use App\ReferralProgram;
use App\Repositories\Contracts\ReferralProgramRepositoryInterface;

class ReferralProgramRepository extends Repository implements ReferralProgramRepositoryInterface
{
    protected $model = ReferralProgram::class;
}
