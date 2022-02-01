<?php


namespace App\Partnerships\Concretes\MetricsDefinition;

use App\AccessTheDeal;
use App\Deal;
use App\DealStatus;
use App\Partnerships\Contracts\MetricsDefinitionInterface;
use App\User;
use Illuminate\Database\Eloquent\Builder;

class ClosedPremiumAmountWithInsurance implements MetricsDefinitionInterface
{
    public static function getTitle(): string
    {
        return 'Amount (USD) of Insurance Premium from Referred Users';
    }

    public static function getDescription(): string
    {
        return 'Amount of Insurance Premium from Referred Users';
    }

    /**
     * @param User $partner
     * @return mixed
     */
    public static function getValue($partner)
    {
        return AccessTheDeal::where('loan_status_id',DealStatus::SIGNED_THE_LOAN)
            ->whereIn('deal_id', Deal::whereIn('deal_type_id',[5])->pluck('id'))
            ->whereHas('user',function($query) use ($partner) {
                $query->where('referred_by_id',$partner->id);
            })
            ->sum('loan_amount');
    }
}
