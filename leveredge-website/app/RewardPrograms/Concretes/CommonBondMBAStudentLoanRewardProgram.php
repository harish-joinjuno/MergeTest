<?php


namespace App\RewardPrograms\Concretes;

use App\AccessTheDeal;
use App\LeveredgeRewardClaim;
use App\RewardPrograms\Abstracts\AbstractRewardProgram;

class CommonBondMBAStudentLoanRewardProgram extends AbstractRewardProgram
{
    public static $title = 'CommonBond MBA Student Loan Reward Program';

    public static function payable(LeveredgeRewardClaim $claim): bool
    {
        if (!$claim->accessTheDeal) {
            return false;
        }
    }

    public static function calculateRewardAmount($loanAmount): int
    {
        return $loanAmount*0.005;
    }
}
