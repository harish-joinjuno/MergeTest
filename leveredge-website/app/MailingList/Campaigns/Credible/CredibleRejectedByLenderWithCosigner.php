<?php


namespace App\MailingList\Campaigns\Credible;


use App\MailingList\Rules\Abstracts\AbstractCampaignList;
use App\MailingList\Rules\Concretes\ExcludeMemberWhoHaveSignedUpForDealRule;
use App\MailingList\Rules\Concretes\NgDomesticCbEligibleOrNgDomesticNonCbGradRule;
use App\MailingList\Rules\Concretes\NotUnsubscribedRule;
use App\MailingList\Rules\Concretes\RejectedByLenderWithCosignerRule;
use App\MailingList\Rules\Concretes\ShouldAddMemberCampaign;

class CredibleRejectedByLenderWithCosigner extends AbstractCampaignList
{
    protected $mailchimpAutomatedCampaignId = 26;

    protected $additionalRules = [];

    protected $rules = [
        NgDomesticCbEligibleOrNgDomesticNonCbGradRule::class,
        ExcludeMemberWhoHaveSignedUpForDealRule::class,
    ];

    public function __construct()
    {
        $this->additionalRules[] = new RejectedByLenderWithCosignerRule(3);
        $this->additionalRules[] = new ShouldAddMemberCampaign(18);
        $this->additionalRules[] = new ShouldAddMemberCampaign($this->mailchimpAutomatedCampaignId);
    }
}
