<?php


namespace App\MailingList\Campaigns\LaurelRoadRefi;


use App\MailingList\Rules\Abstracts\AbstractCampaignList;
use App\MailingList\Rules\Concretes\Deals\Earnest\Refi\EarnestRefiRejectedByLenderRule;
use App\MailingList\Rules\Concretes\Deals\LaurelRoadRefi\LaurelRoadRefiRejectedByLenderRule;
use App\MailingList\Rules\Concretes\NgDomesticCbEligibleOrNgDomesticNonCbGradRule;
use App\MailingList\Rules\Concretes\NotUnsubscribedRule;
use App\MailingList\Rules\Concretes\ShouldAddMemberCampaign;

class LaurelRoadRefiRejectedByLender extends AbstractCampaignList
{
    protected $mailchimpAutomatedCampaignId = 23;

    protected $additionalRules = [];

    protected $rules = [
        NotUnsubscribedRule::class,
        NgDomesticCbEligibleOrNgDomesticNonCbGradRule::class,
        LaurelRoadRefiRejectedByLenderRule::class,
    ];

    public function __construct()
    {
        $this->additionalRules[] = new ShouldAddMemberCampaign($this->mailchimpAutomatedCampaignId);
    }
}
