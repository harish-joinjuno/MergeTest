<?php


namespace App\RewardPrograms\Concretes;


use App\AccessTheDeal;
use App\LeveredgeRewardClaim;
use App\RewardPrograms\Abstracts\AbstractRewardProgram;

class EarnestRefinanceLoanRewardProgramInOtherStates extends AbstractRewardProgram
{

    public static $title = 'Earnest Refinance Loan Reward Program';

    public static function payable(LeveredgeRewardClaim $claim): bool
    {
        if(!$claim->accessTheDeal){
            return false;
        }
    }

    public static function calculateRewardAmount($loan_amount): int
    {
        return 0.005*$loan_amount;
    }
}
