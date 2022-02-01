<?php


namespace App\MailingList\Campaigns\Earnest\Refi;


use App\MailingList\Rules\Abstracts\AbstractCampaignList;
use App\MailingList\Rules\Concretes\Deals\Earnest\Refi\EarnestRefiSignedTheLoanInOtherStatesRule;
use App\MailingList\Rules\Concretes\NgDomesticRefiOrNgNonMedicalInFrOrNgNonMedicalOutsideFr;
use App\MailingList\Rules\Concretes\NotUnsubscribedRule;
use App\MailingList\Rules\Concretes\ShouldAddMemberCampaign;

class EarnestRefiSignedTheLoanInOtherStates extends AbstractCampaignList
{
    protected $mailchimpAutomatedCampaignId = 40;

    protected $additionalRules = [];

    protected $rules = [
        NotUnsubscribedRule::class,
        NgDomesticRefiOrNgNonMedicalInFrOrNgNonMedicalOutsideFr::class,
        EarnestRefiSignedTheLoanInOtherStatesRule::class,
    ];

    public function __construct()
    {
        $this->additionalRules[] = new ShouldAddMemberCampaign($this->mailchimpAutomatedCampaignId);
    }
}
