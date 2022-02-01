<?php


namespace App\MailingList\Campaigns\Earnest\Refi;


use App\MailingList\Rules\Abstracts\AbstractCampaignList;
use App\MailingList\Rules\Concretes\Deals\Earnest\Refi\EarnestRefiRejectedByLenderRule;
use App\MailingList\Rules\Concretes\NgDomesticRefiOrNgNonMedicalInFrOrNgNonMedicalOutsideFr;
use App\MailingList\Rules\Concretes\NotUnsubscribedRule;
use App\MailingList\Rules\Concretes\RejectedByLenderRule;
use App\MailingList\Rules\Concretes\ShouldAddMemberCampaign;

class EarnestRefiRejectedByLender extends AbstractCampaignList
{
    protected $mailchimpAutomatedCampaignId = 20;

    protected $additionalRules = [];

    protected $rules = [
        NotUnsubscribedRule::class,
        NgDomesticRefiOrNgNonMedicalInFrOrNgNonMedicalOutsideFr::class,
        EarnestRefiRejectedByLenderRule::class,
    ];

    public function __construct()
    {
        $this->additionalRules[] = new RejectedByLenderRule([9,10]);
        $this->additionalRules[] = new ShouldAddMemberCampaign($this->mailchimpAutomatedCampaignId);
    }
}

