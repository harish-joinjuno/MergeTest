<?php


namespace App\MailingList\Campaigns\Splash;


use App\MailingList\Rules\Abstracts\AbstractCampaignList;
use App\MailingList\Rules\Concretes\Deals\Splash\SignedTheLoan;
use App\MailingList\Rules\Concretes\NgDomesticRefiOrNgNonMedicalInFrOrNgNonMedicalOutsideFr;
use App\MailingList\Rules\Concretes\ShouldAddMemberCampaign;

class SplashSignedTheLoan extends AbstractCampaignList
{
    protected $mailchimpAutomatedCampaignId = 41;

    protected $additionalRules = [];

    protected $rules = [
        NgDomesticRefiOrNgNonMedicalInFrOrNgNonMedicalOutsideFr::class,
        SignedTheLoan::class,
    ];

    public function __construct()
    {
        $this->additionalRules[] = new ShouldAddMemberCampaign($this->mailchimpAutomatedCampaignId);
    }

}
