<?php


namespace App\MailingList\Rules\Abstracts;

use App\MailchimpAutomatedCampaign;
use App\MailchimpAutomatedCampaignUser;
use App\MailingList\Rules\Contracts\EligibleUsersListInterface;
use App\MarketingEmailUnsubscribe;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\OutputStyle;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\Console\Output\Output;

/**
 * @property  $rules
 * @property  $mailchimpAutomatedCampaignId
 * @property  $additionalRules
 */
abstract class AbstractCampaignList implements EligibleUsersListInterface
{
    public $users = [];

    /**
     * @param OutputStyle $output
     */
    public function getAll(OutputStyle $output)
    {
        $users       = Cache::get('mailchimp_automated_campaign_users');
        $progressBar = $output->createProgressBar($users->count());
        $output->writeln("<info>Pulling members for " . get_called_class() . "</info>");
        foreach ($users as $user) {
            $userPassedRuleCount = 0;
            foreach ($this->rules as $rule) {
                if ((new $rule)->passes($user)) {
                    $userPassedRuleCount ++;
                } else {
                    break;
                }
            }

            if ($userPassedRuleCount === count($this->rules)) {
                $additionalRulesCount = 0;
                foreach ($this->additionalRules as $rule) {
                    if ($rule->passes($user)) {
                        $additionalRulesCount++;
                    } else {
                        break;
                    }
                }

                if ($additionalRulesCount === count($this->additionalRules)) {
                    $mailchimpAutomatedCampaign = MailchimpAutomatedCampaign::find($this->mailchimpAutomatedCampaignId);
                    if (! MarketingEmailUnsubscribe::where('email',$user->email)->whereReason('Unsubscribed via MailChimp, ' . $mailchimpAutomatedCampaign->list_id)->exists()) {
                        $this->users[] = $user;
                    }
                }
            }
            $progressBar->advance();
        }

        foreach ($this->users as $user) {
            $mailchimpAutomatedCampaignUser                                  = new MailchimpAutomatedCampaignUser();
            $mailchimpAutomatedCampaignUser->user_id                         = $user->id;
            $mailchimpAutomatedCampaignUser->mailchimp_automated_campaign_id = $this->mailchimpAutomatedCampaignId;
            $mailchimpAutomatedCampaignUser->send_date                       = Carbon::today();
            $mailchimpAutomatedCampaignUser->status                          = MailchimpAutomatedCampaignUser::STATUS_PENDING_VALIDATION;
            $mailchimpAutomatedCampaignUser->save();
        }

        $progressBar->finish();
    }
}
