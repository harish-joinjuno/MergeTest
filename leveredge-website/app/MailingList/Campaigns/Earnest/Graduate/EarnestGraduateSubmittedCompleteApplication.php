<?php


namespace App\MailingList\Campaigns\Earnest\Graduate;

use App\MailingList\Rules\Abstracts\AbstractCampaignList;
use App\MailingList\Rules\Concretes\Deals\Earnest\Graduate\EarnestGraduateDealSubmittedCompleteApplicationRule;
use App\MailingList\Rules\Concretes\NgDomesticCbEligibleOrNgDomesticNonCbGradRule;
use App\MailingList\Rules\Concretes\NotUnsubscribedRule;
use App\MailingList\Rules\Concretes\ShouldAddMemberCampaign;

class EarnestGraduateSubmittedCompleteApplication extends AbstractCampaignList
{
    protected $mailchimpAutomatedCampaignId = 8;

    protected $additionalRules = [];

    protected $rules = [
        NotUnsubscribedRule::class,
        NgDomesticCbEligibleOrNgDomesticNonCbGradRule::class,
        EarnestGraduateDealSubmittedCompleteApplicationRule::class,
    ];

    public function __construct()
    {
        $this->additionalRules[] = new ShouldAddMemberCampaign($this->mailchimpAutomatedCampaignId);
    }
}
