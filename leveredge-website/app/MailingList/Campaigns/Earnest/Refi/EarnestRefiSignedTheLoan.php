<?php


namespace App\MailingList\Campaigns\Earnest\Refi;


use App\MailingList\Rules\Abstracts\AbstractCampaignList;
use App\MailingList\Rules\Concretes\Deals\Earnest\Refi\EarnestRefiSignedTheLoanRule;
use App\MailingList\Rules\Concretes\NgDomesticRefiOrNgNonMedicalInFrOrNgNonMedicalOutsideFr;
use App\MailingList\Rules\Concretes\NotUnsubscribedRule;
use App\MailingList\Rules\Concretes\ShouldAddMemberCampaign;

class EarnestRefiSignedTheLoan extends AbstractCampaignList
{
    protected $mailchimpAutomatedCampaignId = 21;

    protected $additionalRules = [];

    protected $rules = [
        NgDomesticRefiOrNgNonMedicalInFrOrNgNonMedicalOutsideFr::class,
        EarnestRefiSignedTheLoanRule::class,
    ];

    public function __construct()
    {
        $this->additionalRules[] = new ShouldAddMemberCampaign($this->mailchimpAutomatedCampaignId);
    }
}
