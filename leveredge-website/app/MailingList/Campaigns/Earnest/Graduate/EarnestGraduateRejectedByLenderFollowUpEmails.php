<?php


namespace App\MailingList\Campaigns\Earnest\Graduate;


use App\MailingList\Rules\Abstracts\AbstractCampaignList;
use App\MailingList\Rules\Concretes\Deals\Earnest\Graduate\EarnestGraduateDealRejectedByLenderRule;
use App\MailingList\Rules\Concretes\ExcludeMemberWhoHaveSignedUpForDealRule;
use App\MailingList\Rules\Concretes\NgDomesticCbEligibleOrNgDomesticNonCbGradRule;
use App\MailingList\Rules\Concretes\NotUnsubscribedRule;
use App\MailingList\Rules\Concretes\RejectedByLenderWithoutCosignerRule;
use App\MailingList\Rules\Concretes\ShouldAddFollowUpCampaign;
use App\MailingList\Rules\Concretes\ShouldAddMemberCampaign;

class EarnestGraduateRejectedByLenderFollowUpEmails extends AbstractCampaignList
{
    protected $mailchimpAutomatedCampaignId = 10;

    protected $additionalRules = [];

    protected $rules = [
        NgDomesticCbEligibleOrNgDomesticNonCbGradRule::class,
        EarnestGraduateDealRejectedByLenderRule::class,
        ExcludeMemberWhoHaveSignedUpForDealRule::class,
    ];

    public function __construct()
    {
        $this->additionalRules[] = new RejectedByLenderWithoutCosignerRule(7);
        $this->additionalRules[] = new ShouldAddFollowUpCampaign(9, 7);
        $this->additionalRules[] = new ShouldAddMemberCampaign($this->mailchimpAutomatedCampaignId);
    }
}