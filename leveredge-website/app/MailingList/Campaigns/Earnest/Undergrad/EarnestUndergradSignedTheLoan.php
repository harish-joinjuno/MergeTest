<?php


namespace App\MailingList\Campaigns\Earnest\Undergrad;


use App\MailingList\Rules\Abstracts\AbstractCampaignList;
use App\MailingList\Rules\Concretes\Deals\Earnest\Undergrad\EarnestUndergradLoanSignedTheLoan;
use App\MailingList\Rules\Concretes\NgDomesticUndergrad;
use App\MailingList\Rules\Concretes\NotUnsubscribedRule;
use App\MailingList\Rules\Concretes\ShouldAddMemberCampaign;

class EarnestUndergradSignedTheLoan extends AbstractCampaignList
{
    protected $mailchimpAutomatedCampaignId = 15;

    protected $additionalRules = [];

    protected $rules = [
        NgDomesticUndergrad::class,
        EarnestUndergradLoanSignedTheLoan::class,
    ];

    public function __construct()
    {
        $this->additionalRules[] = new ShouldAddMemberCampaign($this->mailchimpAutomatedCampaignId);
    }
}
