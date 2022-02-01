<?php


namespace App\Partnerships\Concretes\MetricsDefinition;

use App\PartnerProfile;
use App\Partnerships\Contracts\MetricsDefinitionInterface;
use App\PartnerType;
use App\User;

class ReferredUsersByCampusAmbassador implements MetricsDefinitionInterface
{
    public static function getTitle(): string
    {
        return 'Members Referred by a Campus Ambassadors';
    }

    public static function getDescription(): string
    {
        return 'Members referred to LeverEdge by a campus ambassador. They must have provided an email and password.';
    }

    /**
     * @param User $partner
     * @return mixed
     */
    public static function getValue($partner)
    {
        $campus_ambassador_ids = PartnerProfile::where('partner_type_id',PartnerType::TYPE_CAMPUS_AMBASSADOR_ID)->pluck('user_id');
        return User::whereIn('referred_by_id',$campus_ambassador_ids)->count();
    }
}
