<?php


namespace App\RewardPrograms\Concretes;

use App\LeveredgeRewardClaim;
use App\RewardPrograms\Abstracts\AbstractRewardProgram;

class SplashRewardProgram extends AbstractRewardProgram
{
    public static $title = 'First Republic Reward Program';

    public static function payable(LeveredgeRewardClaim $claim): bool
    {
        if (!$claim->accessTheDeal) {
            return false;
        }
    }

    public static function calculateRewardAmount($loan_amount): int
    {
        if ($loan_amount > 50000) {
            return 300;
        }

        return 0;
    }

    public static function calculateLenderAdministeredRewardAmount($loanAmount): int
    {
        if ($loanAmount > 50000) {
            return 300;
        }

        return 0;
    }

    public static function calculateOverallReward($loanAmount): int
    {
        return self::calculateRewardAmount($loanAmount) + self::calculateLenderAdministeredRewardAmount($loanAmount);
    }
}
