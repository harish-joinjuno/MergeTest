<?php


namespace App\Partnerships\Concretes\MetricsDefinition;

use App\AccessTheDeal;
use App\Deal;
use App\DealStatus;
use App\PartnerProfile;
use App\Partnerships\Contracts\MetricsDefinitionInterface;
use App\PartnerType;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ClosedLoanAmountByUsersReferredByCampusAmbassadors implements MetricsDefinitionInterface
{
    public static function getTitle(): string
    {
        return 'Users Referred By Campus Ambassadors Clicked To Provider';
    }

    public static function getDescription(): string
    {
        return 'Users Referred By Campus Ambassadors Clicked To Provider';
    }

    /**
     * @param User $partner
     * @return mixed
     */
    public static function getValue(User $partner)
    {
        $campus_ambassador_ids = PartnerProfile::where('partner_type_id',PartnerType::TYPE_CAMPUS_AMBASSADOR_ID)->pluck('user_id');

        $relevantAccessTheDealIds = AccessTheDeal::where('loan_status_id',DealStatus::SIGNED_THE_LOAN)
            ->select(DB::raw('min(id) as first_id'))
            ->whereIn('deal_id', Deal::whereIn('deal_type_id',[1,2,3,4])->pluck('id'))
            ->whereHas('user',function(Builder $query) use ($campus_ambassador_ids) {
                $query->whereIn('referred_by_id',$campus_ambassador_ids);
            })->groupBy('user_id')->pluck('first_id');

        return AccessTheDeal::whereIn('id',$relevantAccessTheDealIds)->sum('loan_amount');
    }
}
