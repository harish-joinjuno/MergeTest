<?php


namespace App\MailingList\Rules\Concretes;


use App\AccessTheDeal;
use App\MailingList\Rules\Contracts\MailingListRuleInterface;
use App\User;

class ExcludeMemberWhoHaveSignedUpForDealRule implements MailingListRuleInterface
{
    public function passes(User $user)
    {
        $hasSignedUpForDeal = AccessTheDeal::where('user_id',$user->id)
            ->whereIn('deal_id',[3,6,7,8])
            ->whereIn('loan_status_id', [8,13])
            ->exists();

        return ! $hasSignedUpForDeal;
    }
}
