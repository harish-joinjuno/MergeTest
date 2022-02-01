<?php


namespace App\MailingList\Rules\Concretes;


use App\MailchimpAutomatedCampaign;
use App\MailchimpAutomatedCampaignUser;
use App\MailingList\Rules\Contracts\MailingListRuleInterface;
use App\User;

class ShouldAddMemberCampaign implements MailingListRuleInterface
{
    protected $mailchimpAutomatedCampaignId;

    public function __construct(int $mailchimpAutomatedCampaignId)
    {
        $this->mailchimpAutomatedCampaignId = $mailchimpAutomatedCampaignId;
    }

    public function passes(User $user)
    {
        $mailchimpAutomatedCampaign = MailchimpAutomatedCampaign::find($this->mailchimpAutomatedCampaignId);

        $userReceivedCampaignEmail = MailchimpAutomatedCampaignUser::where('user_id', $user->id)
            ->where('mailchimp_automated_campaign_id', $this->mailchimpAutomatedCampaignId)
            ->exists();

        return ! $userReceivedCampaignEmail || $mailchimpAutomatedCampaign->allow_multiple_emails;
    }
}
