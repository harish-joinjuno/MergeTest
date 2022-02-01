<?php


namespace App\Partnerships\Concretes\MetricsDefinition;

use App\AccessTheDeal;
use App\Deal;
use App\PartnerProfile;
use App\Partnerships\Contracts\MetricsDefinitionInterface;
use App\PartnerType;
use App\User;
use Illuminate\Database\Eloquent\Builder;

class UsersReferredByCampusAmbassadorsClickedToLender implements MetricsDefinitionInterface
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
    public static function getValue($partner)
    {
        $campus_ambassador_ids = PartnerProfile::where('partner_type_id',PartnerType::TYPE_CAMPUS_AMBASSADOR_ID)->pluck('user_id');

        return User::whereHas('accessTheDeals',function(Builder $query) {
            $query->whereIn('deal_id', Deal::whereIn('deal_type_id',[1,2,3,4])->pluck('id'));
        })->whereIn('referred_by_id',$campus_ambassador_ids)->count();
    }
}
