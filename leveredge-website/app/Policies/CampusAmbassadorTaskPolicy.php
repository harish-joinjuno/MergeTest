<?php

namespace App\Policies;

use App\CampusAmbassadorTask;
use App\PartnerType;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CampusAmbassadorTaskPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->hasRole('admin')) {
            return true;
        }

        return null;
    }

    public function create(User $user)
    {
        return true;
    }

    public function view(User $user, CampusAmbassadorTask $task)
    {
        return $user->partnerProfile()
            ->join('partner_types', 'partner_types.id', '=', 'partner_profiles.partner_type_id')
            ->where('partner_types.type', '=', PartnerType::TYPE_CAMPUS_AMBASSADOR)
            ->exists();
    }

    public function complete(User $user, CampusAmbassadorTask $task)
    {
        return $user->partnerProfile()
            ->join('partner_types', 'partner_types.id', '=', 'partner_profiles.partner_type_id')
            ->where('partner_types.type', '=', PartnerType::TYPE_CAMPUS_AMBASSADOR)
            ->exists();
    }
}
