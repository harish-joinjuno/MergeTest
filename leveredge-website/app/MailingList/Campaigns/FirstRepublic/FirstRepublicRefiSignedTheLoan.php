<?php


namespace App\MailingList\Campaigns\FirstRepublic;


use App\MailingList\Rules\Abstracts\AbstractCampaignList;
use App\MailingList\Rules\Concretes\Deals\Earnest\Refi\EarnestRefiSignedTheLoanRule;
use App\MailingList\Rules\Concretes\Deals\Earnest\Undergrad\EarnestUndergradLoanSignedTheLoan;
use App\MailingList\Rules\Concretes\Deals\FirstRepublicRefi\FirstRepublicRefiSignedTheLoanRule;
use App\MailingList\Rules\Concretes\Deals\LaurelRoadRefi\LaurelRoadRefiSignedTheLoanRule;
use App\MailingList\Rules\Concretes\NgDomesticCbEligibleOrNgDomesticNonCbGradRule;
use App\MailingList\Rules\Concretes\NotUnsubscribedRule;
use App\MailingList\Rules\Concretes\ShouldAddMemberCampaign;

class FirstRepublicRefiSignedTheLoan extends AbstractCampaignList
{
    protected $mailchimpAutomatedCampaignId = 24;

    protected $additionalRules = [];

    protected $rules = [
        NotUnsubscribedRule::class,
        NgDomesticCbEligibleOrNgDomesticNonCbGradRule::class,
        FirstRepublicRefiSignedTheLoanRule::class,
    ];

    public function __construct()
    {
        $this->additionalRules[] = new ShouldAddMemberCampaign($this->mailchimpAutomatedCampaignId);
    }
}
