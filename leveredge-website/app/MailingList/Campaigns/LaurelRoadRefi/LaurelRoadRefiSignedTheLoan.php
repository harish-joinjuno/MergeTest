<?php


namespace App\MailingList\Campaigns\LaurelRoadRefi;


use App\MailingList\Rules\Abstracts\AbstractCampaignList;
use App\MailingList\Rules\Concretes\Deals\Earnest\Refi\EarnestRefiSignedTheLoanRule;
use App\MailingList\Rules\Concretes\Deals\Earnest\Undergrad\EarnestUndergradLoanSignedTheLoan;
use App\MailingList\Rules\Concretes\Deals\LaurelRoadRefi\LaurelRoadRefiSignedTheLoanRule;
use App\MailingList\Rules\Concretes\NgDomesticCbEligibleOrNgDomesticNonCbGradRule;
use App\MailingList\Rules\Concretes\NotUnsubscribedRule;
use App\MailingList\Rules\Concretes\ShouldAddMemberCampaign;

class LaurelRoadRefiSignedTheLoan extends AbstractCampaignList
{
    protected $mailchimpAutomatedCampaignId = 22;

    protected $additionalRules = [];

    protected $rules = [
        NotUnsubscribedRule::class,
        NgDomesticCbEligibleOrNgDomesticNonCbGradRule::class,
        LaurelRoadRefiSignedTheLoanRule::class,
    ];

    public function __construct()
    {
        $this->additionalRules[] = new ShouldAddMemberCampaign($this->mailchimpAutomatedCampaignId);
    }
}
