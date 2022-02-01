<?php


namespace App\Partnerships\Concretes\MetricsDefinition;


use App\Deal;
use App\DealStatus;
use App\Partnerships\Contracts\MetricsDefinitionInterface;
use App\User;
use Illuminate\Database\Eloquent\Builder;

class ClosedWithInsurance implements MetricsDefinitionInterface
{
    public static function getTitle(): string
    {
        return 'Number of Referred Users who closed with insurance';
    }

    public static function getDescription(): string
    {
        return 'Number of Referred Users who closed with insurance';
    }

    /**
     * @param User $partner
     * @return mixed
     */
    public static function getValue($partner)
    {
        return User::where('referred_by_id',$partner->id)
            ->whereHas('accessTheDeals',function(Builder $query) {
                $query->where('loan_status_id',DealStatus::SIGNED_THE_LOAN);
                $query->whereIn('deal_id', Deal::whereIn('deal_type_id',[5])->pluck('id'));
            })
            ->count();
    }
}
