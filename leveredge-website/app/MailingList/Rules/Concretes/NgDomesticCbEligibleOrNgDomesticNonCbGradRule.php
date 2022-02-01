<?php


namespace App\MailingList\Rules\Concretes;


use App\MailingList\Rules\Contracts\MailingListRuleInterface;
use App\NegotiationGroup;
use App\NegotiationGroupUser;
use App\User;

class NgDomesticCbEligibleOrNgDomesticNonCbGradRule implements MailingListRuleInterface
{

    const VALID_NEGOTIATION_GROUPS = [
        NegotiationGroup::NG_DOMESTIC_CB_ELIGIBLE,
        NegotiationGroup::NG_DOMESTIC_NON_CB_GRAD,
    ];

    public function passes(User $user)
    {
        return NegotiationGroupUser::where('user_id',$user->id)
            ->whereIn('negotiation_group_id',self::VALID_NEGOTIATION_GROUPS)
            ->exists();
    }
}
