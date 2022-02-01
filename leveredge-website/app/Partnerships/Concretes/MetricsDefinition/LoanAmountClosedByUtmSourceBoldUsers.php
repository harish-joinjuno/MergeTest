<?php


namespace App\Partnerships\Concretes\MetricsDefinition;

use App\AccessTheDeal;
use App\Deal;
use App\DealStatus;
use App\PartnerProfile;
use App\Partnerships\Contracts\MetricsDefinitionInterface;
use App\PartnerType;
use App\User;
use App\UserProfile;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class LoanAmountClosedByUtmSourceBoldUsers implements MetricsDefinitionInterface
{
    public static function getTitle(): string
    {
        return 'Loan Amount Closed by Users who have utm_source = bold';
    }

    public static function getDescription(): string
    {
        return 'Loan Amount Closed by Users who have utm_source = bold';
    }

    /**
     * @param User $partner
     * @return mixed
     */
    public static function getValue($partner)
    {
        $relevantAccessTheDealIds = AccessTheDeal::where('loan_status_id',DealStatus::SIGNED_THE_LOAN)
            ->select(DB::raw('min(id) as first_id'))
            ->whereIn('deal_id', Deal::whereIn('deal_type_id',[1,2,3,4])->pluck('id'))
            ->whereHas('user',function(Builder $query) {
                $query->whereHas('profile',function(Builder $query) {
                    $query->where('utm_source','bold');
                });
            })->groupBy('user_id')->pluck('first_id');

        return AccessTheDeal::whereIn('id',$relevantAccessTheDealIds)->sum('loan_amount');
    }
}
