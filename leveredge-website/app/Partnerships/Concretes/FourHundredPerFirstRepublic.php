<?php


namespace App\Partnerships\Concretes;

use App\AccessTheDeal;
use App\Deal;
use App\DealStatus;
use App\Partnerships\Contracts\ContractTypeDefinitionInterface;
use App\User;
use Illuminate\Database\Eloquent\Builder;

class FourHundredPerFirstRepublic implements ContractTypeDefinitionInterface
{
    public static function getTitle(): string
    {
        return 'Contract for Campus Ambassador Lead (Shehzan)';
    }

    public static function calculateEarnedAmount(User $user): int
    {
        return (AccessTheDeal::where('deal_id',Deal::where('slug',Deal::DEAL_FIRST_REPUBLIC_PLOC_SLUG)->pluck('id'))
            ->where('loan_status_id',DealStatus::SIGNED_THE_LOAN)
            ->where('user', function(Builder $query) use ($user) {
                $query->where('referred_by_id', $user->id);
            })
            ->distinct('user_id')
            ->count('user_id'))*400;
    }
}
