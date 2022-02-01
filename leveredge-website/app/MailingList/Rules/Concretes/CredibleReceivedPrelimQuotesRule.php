<?php


namespace App\MailingList\Rules\Concretes;


use App\AccessTheDeal;
use App\MailingList\Rules\Contracts\MailingListRuleInterface;
use App\User;

class CredibleReceivedPrelimQuotesRule implements MailingListRuleInterface
{
    protected $dealId;

    public function __construct($dealId)
    {
        $this->dealId       = $dealId;
    }

    public function passes(User $user)
    {
        $hasPrelimQuotes = AccessTheDeal::where('user_id',$user->id)
            ->where('deal_id',$this->dealId)
            ->where('loan_status_id', 4)
            ->exists();

        if ($hasPrelimQuotes) {
            //Check if there is approved loan status for this deal for this user
            $hasApprovedStatus = AccessTheDeal::where('user_id',$user->id)
                ->where('deal_id',$this->dealId)
                ->whereIn('loan_status_id', [5,6,8,9,11,12,13])
                ->exists();

            if ($hasApprovedStatus) {
                return false;
            }

            return true;
        }

        return false;
    }
}
