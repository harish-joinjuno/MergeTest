<?php


namespace App\RewardPrograms\Abstracts;

use App\AccessTheDeal;
use App\LeveredgeRewardClaim;
use App\User;

abstract class AbstractRewardProgram
{
    public static $title;

    public static $description;

    abstract public static function calculateRewardAmount(int $loan_amount): int;

    abstract public static function payable(LeveredgeRewardClaim $claim): bool;

    public static function findAccessTheDealRecord(LeveredgeRewardClaim $claim)
    {
        $possibleDeals = AccessTheDeal::where('loan_amount',$claim->loan_amount)
            ->where('deal_id',$claim->deal->id)
            ->where('user_id',$claim->user->id)
            ->get();

        if ($possibleDeals->count() === 1) {
            return $possibleDeals->first();
        }

        return null;
    }

    /**
     * @return mixed
     */
    public static function getTitle()
    {
        return self::$title;
    }

    /**
     * @return mixed
     */
    public static function getDescription()
    {
        return self::$description;
    }
}
