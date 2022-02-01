<?php


namespace App\MailingList\Campaigns\Earnest\Undergrad;

use App\MailingList\Rules\Abstracts\AbstractCampaignList;
use App\MailingList\Rules\Concretes\Deals\Earnest\Undergrad\EarnestUndergradSubmittedCompleteApplicationRule;
use App\MailingList\Rules\Concretes\NgDomesticUndergrad;
use App\MailingList\Rules\Concretes\NotUnsubscribedRule;
use App\MailingList\Rules\Concretes\ShouldAddMemberCampaign;

class EarnestUndergradSubmittedCompleteApplication extends AbstractCampaignList
{
    protected $mailchimpAutomatedCampaignId = 12;

    protected $additionalRules = [];

    protected $rules = [
        NotUnsubscribedRule::class,
        NgDomesticUndergrad::class,
        EarnestUndergradSubmittedCompleteApplicationRule::class,
    ];

    public function __construct()
    {
        $this->additionalRules[] = new ShouldAddMemberCampaign($this->mailchimpAutomatedCampaignId);
    }
}
