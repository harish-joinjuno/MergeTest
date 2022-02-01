<?php


namespace App\Partnerships\Concretes\PremiumSharingInsuranceOnly;

use App\Partnerships\Contracts\ContractTypeDefinitionInterface;
use App\User;

class Main implements ContractTypeDefinitionInterface
{
    public static $percentage;

    public static function getTitle(): string
    {
        return static::$percentage . ' percentage of Premium Sharing Insurance Only';
    }

    public static function calculateEarnedAmount(User $user): int
    {
        $users = User::where('referred_by_id', $user->id)
            ->whereHas('firstInsuranceDealAccessed')
            ->get();

        return $users->sum(function ($user) {
            /** @var User $user */
            return $user->firstInsuranceDealAccessed->disbursed_amount;
        }) * static::$percentage / 100;
    }
}
