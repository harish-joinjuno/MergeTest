<?php


namespace App\MailingList\Campaigns\Earnest\Undergrad;


use App\MailingList\Rules\Abstracts\AbstractCampaignList;
use App\MailingList\Rules\Concretes\Deals\Earnest\Undergrad\EarnestUndergradDealRejectedByLenderRule;
use App\MailingList\Rules\Concretes\ExcludeMemberWhoHaveSignedUpForDealRule;
use App\MailingList\Rules\Concretes\NgDomesticUndergrad;
use App\MailingList\Rules\Concretes\NotUnsubscribedRule;
use App\MailingList\Rules\Concretes\RejectedByLenderWithoutCosignerRule;
use App\MailingList\Rules\Concretes\ShouldAddMemberCampaign;

class EarnestUndergradRejectedByLender extends AbstractCampaignList
{
    protected $mailchimpAutomatedCampaignId = 13;

    protected $additionalRules = [];

    protected $rules = [
        NgDomesticUndergrad::class,
        EarnestUndergradDealRejectedByLenderRule::class,
        ExcludeMemberWhoHaveSignedUpForDealRule::class,
    ];

    public function __construct()
    {
        $this->additionalRules[] = new RejectedByLenderWithoutCosignerRule(8);
        $this->additionalRules[] = new ShouldAddMemberCampaign($this->mailchimpAutomatedCampaignId);
    }
}
