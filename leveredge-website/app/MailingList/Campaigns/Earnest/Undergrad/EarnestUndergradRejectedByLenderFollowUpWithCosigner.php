<?php


namespace App\MailingList\Campaigns\Earnest\Undergrad;


use App\MailingList\Rules\Abstracts\AbstractCampaignList;
use App\MailingList\Rules\Concretes\Deals\Earnest\Undergrad\EarnestUndergradDealRejectedByLenderRule;
use App\MailingList\Rules\Concretes\ExcludeMemberWhoHaveSignedUpForDealRule;
use App\MailingList\Rules\Concretes\NgDomesticUndergrad;
use App\MailingList\Rules\Concretes\NotUnsubscribedRule;
use App\MailingList\Rules\Concretes\RejectedByLenderWithCosignerRule;
use App\MailingList\Rules\Concretes\ShouldAddFollowUpCampaign;
use App\MailingList\Rules\Concretes\ShouldAddMemberCampaign;

class EarnestUndergradRejectedByLenderFollowUpWithCosigner extends AbstractCampaignList
{
    protected $mailchimpAutomatedCampaignId = 31;

    protected $additionalRules = [];

    protected $rules = [
        NotUnsubscribedRule::class,
        NgDomesticUndergrad::class,
        EarnestUndergradDealRejectedByLenderRule::class,
        ExcludeMemberWhoHaveSignedUpForDealRule::class,
    ];

    public function __construct()
    {
        $this->additionalRules[] = new RejectedByLenderWithCosignerRule(8);
        $this->additionalRules[] = new ShouldAddFollowUpCampaign(30, 8);
        $this->additionalRules[] = new ShouldAddMemberCampaign(14);
        $this->additionalRules[] = new ShouldAddMemberCampaign($this->mailchimpAutomatedCampaignId);
    }
}
