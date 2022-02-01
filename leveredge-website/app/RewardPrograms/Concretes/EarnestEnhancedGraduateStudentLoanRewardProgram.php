<?php


namespace App\RewardPrograms\Concretes;


use App\AccessTheDeal;
use App\LeveredgeRewardClaim;
use App\RewardPrograms\Abstracts\AbstractRewardProgram;

class EarnestEnhancedGraduateStudentLoanRewardProgram extends AbstractRewardProgram
{

    public static $title = 'Earnest Graduate Student Loan Reward Program';

    public static function payable(LeveredgeRewardClaim $claim): bool
    {
        if(!$claim->accessTheDeal){
            return false;
        }
    }

    public static function calculateRewardAmount($loan_amount): int
    {
        return $loan_amount*0.008;
    }
}
