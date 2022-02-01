<?php


namespace App\MailingList\Rules\Concretes;


use App\MailingList\Rules\Contracts\MailingListRuleInterface;
use App\MarketingEmailUnsubscribe;
use App\UnsubscribeRequest;
use App\User;

class NotUnsubscribedRule implements MailingListRuleInterface
{

    public function passes(User $user)
    {
        if (UnsubscribeRequest::where('email',$user->email)->exists()) {
            return false;
        }

        return true;
    }
}
