<?php


namespace App\Partnerships\Concretes\NetRevenueSharing;


use App\Partnerships\Contracts\ContractTypeDefinitionInterface;
use App\User;

class Main implements ContractTypeDefinitionInterface
{
    public static $percentage;

    public static function getTitle(): string
    {
        return static::$percentage . ' percent of Net Revenue Sharing';
    }

    public static function calculateEarnedAmount(User $user): int
    {
        $users = User::where('referred_by_id', $user->id)
            ->whereHas('firstDealAccessed')
            ->get();

        return $users->sum(function ($user) {
            return $user->firstDealAccessed->net_revenue;
        }) * static::$percentage / 100;

    }
}
