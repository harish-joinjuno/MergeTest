<?php


namespace App\MailingList\Rules\Concretes;

use App\MailingList\Rules\Contracts\MailingListRuleInterface;
use App\NegotiationGroup;
use App\NegotiationGroupUser;
use App\User;

class NgDomesticRefiOrNgNonMedicalInFrOrNgNonMedicalOutsideFr implements MailingListRuleInterface
{
    const VALID_NEGOTIATION_GROUPS = [
        NegotiationGroup::NG_DOMESTIC_REFINANCE,
        NegotiationGroup::NG_NON_MEDICAL_IN_FR_CITIES,
        NegotiationGroup::NG_NON_MEDICAL_OUTSIDE_FR_CITIES,
    ];

    public function passes(User $user)
    {
        return NegotiationGroupUser::where('user_id',$user->id)
            ->whereIn('negotiation_group_id',self::VALID_NEGOTIATION_GROUPS)
            ->exists();
    }
}
