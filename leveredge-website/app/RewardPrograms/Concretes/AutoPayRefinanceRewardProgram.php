<?php


namespace App\RewardPrograms\Concretes;

use App\AccessTheDeal;
use App\LeveredgeRewardClaim;
use App\RewardPrograms\Abstracts\AbstractRewardProgram;

class AutoPayRefinanceRewardProgram extends AbstractRewardProgram
{
    public static $title = 'Open Road Refinance Reward Program';

    public static function payable(LeveredgeRewardClaim $claim): bool
    {
        if (!$claim->accessTheDeal) {
            return false;
        }

        if ($claim->accessTheDeal->loan_status_id != 8) {
            return false;
        }
    }

    public static function calculateRewardAmount($loanAmount): int
    {
        return 150;
    }
}
