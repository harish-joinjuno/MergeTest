<?php


namespace App\MailingList\Rules\Abstracts;


use App\MailchimpAutomatedCampaign;
use App\MailchimpAutomatedCampaignUser;
use App\MailingList\Rules\Contracts\MailingListRuleInterface;
use App\User;

/**
 * @property  $mailchimpAutomatedCampaignId
 */
abstract class MemberAlreadyInTheCampaignRule implements MailingListRuleInterface
{

}
