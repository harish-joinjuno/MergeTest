<?php


namespace App\Partnerships\Concretes\MetricsDefinition;

use App\AccessTheDeal;
use App\Deal;
use App\DealStatus;
use App\Partnerships\Contracts\MetricsDefinitionInterface;
use App\User;
use Illuminate\Database\Eloquent\Builder;

class NetRevenueForDisbursedLoans implements MetricsDefinitionInterface
{
    public static function getTitle(): string
    {
        return 'Revenue from Disbursed Loans to Referred Users';
    }

    public static function getDescription(): string
    {
        return 'Revenue from Disbursed Loans to Referred Users';
    }

    /**
     * @param User $partner
     * @return mixed
     */
    public static function getValue($partner)
    {
        $referredUsersWithSignedLoans = User::where('referred_by_id',$partner->id)
            ->whereHas('accessTheDeals',function(Builder $query) {
                $query->where('loan_status_id',DealStatus::SIGNED_THE_LOAN);
                $query->whereIn('deal_id', Deal::whereIn('deal_type_id',[1,2,3,4])->pluck('id'));
            })
            ->get();

        $totalNetRevenue = 0;
        /** @var User $user */
        foreach ($referredUsersWithSignedLoans as $user) {
            /** @var AccessTheDeal $loan */
            $loan = AccessTheDeal::where('disbursed_amount','>',0)->where('user_id',$user->id)->first();
            if($loan){
                $totalNetRevenue += $loan->net_revenue;
            }
        }

        return $totalNetRevenue;
    }
}
