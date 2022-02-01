<?php


namespace App\Partnerships\Concretes\LoanAmountSharing;

use App\Partnerships\Contracts\ContractTypeDefinitionInterface;
use App\User;

class Main implements ContractTypeDefinitionInterface
{
    public static $percentage;

    public static function getTitle(): string
    {
        return static::$percentage . ' percent of Loan Amount Sharing';
    }

    public static function calculateEarnedAmount(User $user): int
    {
        $users = User::where('referred_by_id', $user->id)
            ->whereHas('firstLoanDealAccessed')
            ->get();

        return $users->sum(function ($user) {
            /** @var User $user */
            return $user->firstLoanDealAccessed->disbursed_amount;
        }) * static::$percentage / 100;
    }
}
