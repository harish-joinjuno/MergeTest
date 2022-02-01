<?php


namespace App\MailingList\Rules\Concretes;

use App\AccessTheDeal;
use App\MailingList\Rules\Contracts\MailingListRuleInterface;
use App\User;

class EarnestCheckForReceivedQuotes implements MailingListRuleInterface
{
    protected $dealId;

    protected $loanStatusId;

    public function __construct($dealId)
    {
        $this->dealId       = $dealId;
    }

    public function passes(User $user)
    {
        $hasReceivedQuotes = AccessTheDeal::where('user_id',$user->id)
            ->where('deal_id',$this->dealId)
            ->where('loan_status_id', 7)
            ->exists();

        if ($hasReceivedQuotes) {
            //Check if there is approved loan status for this deal for this user
            $hasApprovedStatus = AccessTheDeal::where('user_id',$user->id)
                ->where('deal_id',$this->dealId)
                ->whereIn('loan_status_id', [8,9])
                ->exists();

            if ($hasApprovedStatus) {
                return false;
            }

            return true;
        }

        return false;
    }
}
