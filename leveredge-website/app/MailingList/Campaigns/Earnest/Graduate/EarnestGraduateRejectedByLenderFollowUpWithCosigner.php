<?php


namespace App\MailingList\Campaigns\Earnest\Graduate;


use App\MailingList\Rules\Abstracts\AbstractCampaignList;
use App\MailingList\Rules\Concretes\Deals\Earnest\Graduate\EarnestGraduateDealRejectedByLenderRule;
use App\MailingList\Rules\Concretes\ExcludeMemberWhoHaveSignedUpForDealRule;
use App\MailingList\Rules\Concretes\NgDomesticCbEligibleOrNgDomesticNonCbGradRule;
use App\MailingList\Rules\Concretes\NotUnsubscribedRule;
use App\MailingList\Rules\Concretes\RejectedByLenderWithCosignerRule;
use App\MailingList\Rules\Concretes\ShouldAddFollowUpCampaign;
use App\MailingList\Rules\Concretes\ShouldAddMemberCampaign;

class EarnestGraduateRejectedByLenderFollowUpWithCosigner extends AbstractCampaignList
{
    protected $mailchimpAutomatedCampaignId = 29;

    protected $additionalRules = [];

    protected $rules = [
        NotUnsubscribedRule::class,
        NgDomesticCbEligibleOrNgDomesticNonCbGradRule::class,
        EarnestGraduateDealRejectedByLenderRule::class,
        ExcludeMemberWhoHaveSignedUpForDealRule::class,
    ];

    public function __construct()
    {
        $this->additionalRules[] = new RejectedByLenderWithCosignerRule(7);
        $this->additionalRules[] = new ShouldAddFollowUpCampaign(28, 7);
        $this->additionalRules[] = new ShouldAddMemberCampaign(10);
        $this->additionalRules[] = new ShouldAddMemberCampaign($this->mailchimpAutomatedCampaignId);
    }
}
