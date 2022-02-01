<?php


namespace App\MailingList\Campaigns\Credible;


use App\MailingList\Rules\Abstracts\AbstractCampaignList;
use App\MailingList\Rules\Concretes\Deals\Credible\CredibleRejectByLenderRule;
use App\MailingList\Rules\Concretes\ExcludeMemberWhoHaveSignedUpForDealRule;
use App\MailingList\Rules\Concretes\NgDomesticCbEligibleOrNgDomesticNonCbGradRule;
use App\MailingList\Rules\Concretes\NotUnsubscribedRule;
use App\MailingList\Rules\Concretes\RejectedByLenderWithoutCosignerRule;
use App\MailingList\Rules\Concretes\ShouldAddFollowUpCampaign;
use App\MailingList\Rules\Concretes\ShouldAddMemberCampaign;

class CredibleRejectedByLenderFollowUp extends AbstractCampaignList
{
    protected $mailchimpAutomatedCampaignId = 19;

    protected $additionalRules = [];

    protected $rules = [
        NgDomesticCbEligibleOrNgDomesticNonCbGradRule::class,
        CredibleRejectByLenderRule::class,
        ExcludeMemberWhoHaveSignedUpForDealRule::class,
    ];

    public function __construct()
    {
        $this->additionalRules[] = new RejectedByLenderWithoutCosignerRule(3);
        $this->additionalRules[] = new ShouldAddFollowUpCampaign(18, 3);
        $this->additionalRules[] = new ShouldAddMemberCampaign($this->mailchimpAutomatedCampaignId);
    }
}
