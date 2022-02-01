<?php


namespace App\MailingList\Campaigns\Earnest\Graduate;


use App\MailingList\Rules\Abstracts\AbstractCampaignList;
use App\MailingList\Rules\Concretes\ExcludeMemberWhoHaveSignedUpForDealRule;
use App\MailingList\Rules\Concretes\NgDomesticCbEligibleOrNgDomesticNonCbGradRule;
use App\MailingList\Rules\Concretes\NotUnsubscribedRule;
use App\MailingList\Rules\Concretes\RejectedByLenderWithoutCosignerRule;
use App\MailingList\Rules\Concretes\ShouldAddMemberCampaign;

class EarnestGraduateRejectedByLender extends AbstractCampaignList
{
    protected $mailchimpAutomatedCampaignId = 9;

    protected $additionalRules = [];

    protected $rules = [
        NgDomesticCbEligibleOrNgDomesticNonCbGradRule::class,
        ExcludeMemberWhoHaveSignedUpForDealRule::class,
    ];

    public function __construct()
    {
        $this->additionalRules[] = new RejectedByLenderWithoutCosignerRule(7);
        $this->additionalRules[] = new ShouldAddMemberCampaign($this->mailchimpAutomatedCampaignId);
    }
}
