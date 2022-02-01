<?php


namespace App\MailingList\Campaigns\Earnest\Graduate;


use App\MailingList\Rules\Abstracts\AbstractCampaignList;
use App\MailingList\Rules\Concretes\Deals\Earnest\Graduate\EarnestGraduateLoanSignedTheLoan;
use App\MailingList\Rules\Concretes\NgDomesticCbEligibleOrNgDomesticNonCbGradRule;
use App\MailingList\Rules\Concretes\NotUnsubscribedRule;
use App\MailingList\Rules\Concretes\ShouldAddMemberCampaign;

class EarnestGraduateSignedTheLoan extends AbstractCampaignList
{
    protected $mailchimpAutomatedCampaignId = 11;

    protected $additionalRules = [];

    protected $rules = [
        NgDomesticCbEligibleOrNgDomesticNonCbGradRule::class,
        EarnestGraduateLoanSignedTheLoan::class,
    ];

    public function __construct()
    {
        $this->additionalRules[] = new ShouldAddMemberCampaign($this->mailchimpAutomatedCampaignId);
    }
}
