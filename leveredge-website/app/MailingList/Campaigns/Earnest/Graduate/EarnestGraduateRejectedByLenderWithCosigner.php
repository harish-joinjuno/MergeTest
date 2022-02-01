<?php


namespace App\MailingList\Campaigns\Earnest\Graduate;


use App\MailingList\Rules\Abstracts\AbstractCampaignList;
use App\MailingList\Rules\Concretes\ExcludeMemberWhoHaveSignedUpForDealRule;
use App\MailingList\Rules\Concretes\NgDomesticCbEligibleOrNgDomesticNonCbGradRule;
use App\MailingList\Rules\Concretes\NotUnsubscribedRule;
use App\MailingList\Rules\Concretes\RejectedByLenderWithCosignerRule;
use App\MailingList\Rules\Concretes\ShouldAddMemberCampaign;

class EarnestGraduateRejectedByLenderWithCosigner extends AbstractCampaignList
{
    protected $mailchimpAutomatedCampaignId = 28;

    protected $additionalRules = [];

    protected $rules = [
        NgDomesticCbEligibleOrNgDomesticNonCbGradRule::class,
        ExcludeMemberWhoHaveSignedUpForDealRule::class,
    ];

    public function __construct()
    {
        $this->additionalRules[] = new RejectedByLenderWithCosignerRule(7);
        $this->additionalRules[] = new ShouldAddMemberCampaign(9);
        $this->additionalRules[] = new ShouldAddMemberCampaign($this->mailchimpAutomatedCampaignId);
    }
}
