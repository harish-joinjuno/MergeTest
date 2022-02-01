<?php

namespace App\Jobs;

use App\MailchimpAutomatedCampaignUser;
use App\QuestionFlow;
use App\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class IncompleteAbandonmentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->user->refresh();
        $profile = $this->user->profile;

        if (is_null($profile->loan_type) && $this->user->questionPageResponders()->count() === 0) {
            $memberAlreadyReceivedMAC = MailchimpAutomatedCampaignUser::whereUserId($this->user->id)
                ->whereMailchimpAutomatedCampaignId(QuestionFlow::LEAD_NOT_REGISTERED_ID)
                ->exists();

            if (! $memberAlreadyReceivedMAC || QuestionFlow::find(QuestionFlow::LEAD_NOT_REGISTERED_ID)->allow_multiple_emails) {
                /** @var MailchimpAutomatedCampaignUser $mailchimpAutomatedCampaignUser */
                $mailchimpAutomatedCampaignUser = $this->user->mailchimpAutomatedCampaignUser()->create([
                    'mailchimp_automated_campaign_id' => QuestionFlow::LEAD_NOT_REGISTERED_ID,
                    'send_date'                       => Carbon::today(),
                    'status'                          => MailchimpAutomatedCampaignUser::STATUS_PENDING_VALIDATION,
                ]);

                $mailchimpAutomatedCampaignUser->send();
            }
        }
    }
}
