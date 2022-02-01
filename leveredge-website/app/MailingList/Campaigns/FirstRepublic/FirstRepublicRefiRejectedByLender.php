<?php


namespace App\MailingList\Campaigns\FirstRepublic;


use App\MailingList\Rules\Abstracts\AbstractCampaignList;
use App\MailingList\Rules\Concretes\Deals\Earnest\Refi\EarnestRefiRejectedByLenderRule;
use App\MailingList\Rules\Concretes\Deals\FirstRepublicRefi\FirstRepublicRefiRejectedByLenderRule;
use App\MailingList\Rules\Concretes\Deals\LaurelRoadRefi\LaurelRoadRefiRejectedByLenderRule;
use App\MailingList\Rules\Concretes\NgDomesticCbEligibleOrNgDomesticNonCbGradRule;
use App\MailingList\Rules\Concretes\NotUnsubscribedRule;
use App\MailingList\Rules\Concretes\ShouldAddMemberCampaign;

class FirstRepublicRefiRejectedByLender extends AbstractCampaignList
{
    protected $mailchimpAutomatedCampaignId = 25;

    protected $additionalRules = [];

    protected $rules = [
        NotUnsubscribedRule::class,
        NgDomesticCbEligibleOrNgDomesticNonCbGradRule::class,
        FirstRepublicRefiRejectedByLenderRule::class,
    ];

    public function __construct()
    {
        $this->additionalRules[] = new ShouldAddMemberCampaign($this->mailchimpAutomatedCampaignId);
    }
}
