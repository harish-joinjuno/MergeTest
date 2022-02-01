<?php


namespace App\MailingList\Campaigns\Credible;

use App\MailingList\Rules\Abstracts\AbstractCampaignList;
use App\MailingList\Rules\Concretes\Deals\Credible\CredibleReceivedPrelimQuotesRule;
use App\MailingList\Rules\Concretes\ExcludeMemberWhoHaveSignedUpForDealRule;
use App\MailingList\Rules\Concretes\NgDomesticCbEligibleOrNgDomesticNonCbGradRule;
use App\MailingList\Rules\Concretes\NotUnsubscribedRule;
use App\MailingList\Rules\Concretes\ShouldAddMemberCampaign;

class CredibleReceivedPrelimQuotes extends AbstractCampaignList
{
    protected $mailchimpAutomatedCampaignId = 17;

    protected $additionalRules = [];

    protected $rules = [
        NgDomesticCbEligibleOrNgDomesticNonCbGradRule::class,
        CredibleReceivedPrelimQuotesRule::class,
        ExcludeMemberWhoHaveSignedUpForDealRule::class,
    ];

    public function __construct()
    {
        $this->additionalRules[] = new \App\MailingList\Rules\Concretes\CredibleReceivedPrelimQuotesRule(3);
        $this->additionalRules[] = new ShouldAddMemberCampaign($this->mailchimpAutomatedCampaignId);
    }
}
