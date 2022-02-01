<?php


namespace App\MailingList\Campaigns\Earnest\Undergrad;


use App\MailingList\Rules\Abstracts\AbstractCampaignList;
use App\MailingList\Rules\Concretes\Deals\Earnest\Undergrad\EarnestUndergradDealRejectedByLenderRule;
use App\MailingList\Rules\Concretes\ExcludeMemberWhoHaveSignedUpForDealRule;
use App\MailingList\Rules\Concretes\NgDomesticUndergrad;
use App\MailingList\Rules\Concretes\NotUnsubscribedRule;
use App\MailingList\Rules\Concretes\RejectedByLenderWithCosignerRule;
use App\MailingList\Rules\Concretes\ShouldAddMemberCampaign;

class EarnestUndergradRejectedByLenderWithCosigner extends AbstractCampaignList
{
    protected $mailchimpAutomatedCampaignId = 30;

    protected $additionalRules = [];

    protected $rules = [
        NgDomesticUndergrad::class,
        EarnestUndergradDealRejectedByLenderRule::class,
        ExcludeMemberWhoHaveSignedUpForDealRule::class,
    ];

    public function __construct()
    {
        $this->additionalRules[] = new RejectedByLenderWithCosignerRule(8);
        $this->additionalRules[] = new ShouldAddMemberCampaign(13);
        $this->additionalRules[] = new ShouldAddMemberCampaign($this->mailchimpAutomatedCampaignId);
    }
}

