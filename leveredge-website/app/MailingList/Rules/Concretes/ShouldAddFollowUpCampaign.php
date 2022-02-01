<?php


namespace App\MailingList\Rules\Concretes;

use App\AccessTheDeal;
use App\MailchimpAutomatedCampaignUser;
use App\MailingList\Rules\Contracts\MailingListRuleInterface;
use App\User;
use Carbon\Carbon;

class ShouldAddFollowUpCampaign implements MailingListRuleInterface
{
    protected $mailchimpAutomatedCampaignId;

    protected $dealId;

    protected $loanStatusesIds;

    public function __construct(int $mailchimpAutomatedCampaignId, int $dealId)
    {
        $this->mailchimpAutomatedCampaignId = $mailchimpAutomatedCampaignId;
        $this->dealId                       = $dealId;
    }

    public function passes(User $user)
    {
        $userReceivedRejectionCampaignEmail = MailchimpAutomatedCampaignUser::where('user_id', $user->id)
            ->where('mailchimp_automated_campaign_id', $this->mailchimpAutomatedCampaignId)
            ->whereIn('status', [MailchimpAutomatedCampaignUser::STATUS_CALL_SENT, MailchimpAutomatedCampaignUser::STATUS_CONFIRMED_BY_MAILCHIMP])
            ->first();

        //Loan status id SUBMITTED COMPLETED APPLICATION/RECEIVED QUOTES (5,7,8)

        if (is_object($userReceivedRejectionCampaignEmail)) {
//            $accessTheDeals = AccessTheDeal::where('user_id',$user->id)
//                ->where('deal_id',$this->dealId)
//                ->where('loan_status_id', 9)
//                ->get();

//            $lastDeal = $accessTheDeals->sortByDesc('id')->first();

            if ($userReceivedRejectionCampaignEmail->updated_at->diffInDays(Carbon::now()) >= 5) {
                return true;
            }
        }

        return false;
    }
}
