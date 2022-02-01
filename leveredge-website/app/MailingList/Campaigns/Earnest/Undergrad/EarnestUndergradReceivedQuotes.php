<?php


namespace App\MailingList\Campaigns\Earnest\Undergrad;


use App\MailingList\Rules\Abstracts\AbstractCampaignList;
use App\MailingList\Rules\Concretes\Deals\Earnest\Undergrad\EarnestUndergradReceivedQuotesRule;
use App\MailingList\Rules\Concretes\Deals\Earnest\Undergrad\EarnestUndergradSubmittedCompleteApplicationRule;
use App\MailingList\Rules\Concretes\EarnestCheckForReceivedQuotes;
use App\MailingList\Rules\Concretes\ExcludeMemberWhoHaveSignedUpForDealRule;
use App\MailingList\Rules\Concretes\NgDomesticUndergrad;
use App\MailingList\Rules\Concretes\NotUnsubscribedRule;
use App\MailingList\Rules\Concretes\ShouldAddMemberCampaign;

class EarnestUndergradReceivedQuotes extends AbstractCampaignList
{
    protected $mailchimpAutomatedCampaignId = 12;

    protected $additionalRules = [];

    protected $rules = [
        NgDomesticUndergrad::class,
        EarnestUndergradReceivedQuotesRule::class,
        ExcludeMemberWhoHaveSignedUpForDealRule::class,
    ];

    public function __construct()
    {
        $this->additionalRules[] = new EarnestCheckForReceivedQuotes(8);
        $this->additionalRules[] = new ShouldAddMemberCampaign($this->mailchimpAutomatedCampaignId);
    }
}
