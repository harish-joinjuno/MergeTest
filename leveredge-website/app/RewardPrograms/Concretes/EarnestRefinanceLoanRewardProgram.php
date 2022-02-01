<?php


namespace App\RewardPrograms\Concretes;

use App\LeveredgeRewardClaim;
use App\RewardPrograms\Abstracts\AbstractRewardProgram;

class EarnestRefinanceLoanRewardProgram extends AbstractRewardProgram
{
    public static $title = 'Earnest Refinance Loan Reward Program';

    public static function payable(LeveredgeRewardClaim $claim): bool
    {
        if (!$claim->accessTheDeal) {
            return false;
        }
    }

    public static function calculateRewardAmount($loan_amount): int
    {
        if ($loan_amount < 75000) {
            return 0;
        }
        if ($loan_amount < 100000) {
            return 250;
        }
        if ($loan_amount >= 100000) {
            return 500;
        }

        return 0;
    }

    public static function calculateLenderAdministeredRewardAmount($loanAmount): int
    {
        return 500;
    }

    public static function calculateOverallReward($loanAmount): int
    {
        return self::calculateRewardAmount($loanAmount) + self::calculateLenderAdministeredRewardAmount($loanAmount);
    }
}
