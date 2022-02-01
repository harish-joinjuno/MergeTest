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

class QuestionFlowAbandonmentEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;

    public $questionFlow;

    /**
     * Create a new job instance.
     *
     * @param QuestionFlow $questionFlow
     * @param User $user
     */
    public function __construct(QuestionFlow $questionFlow, User $user)
    {
        $this->user         = $user;
        $this->questionFlow = $questionFlow;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->user->refresh();
        $questionFlowResponder = $this->user
            ->questionFlowResponders()
            ->whereQuestionFlowId($this->questionFlow->id)
            ->whereNotNull('completed_at')
            ->exists();

        if (! $questionFlowResponder) {
            if ($this->questionFlow->mailable) {
                $memberAlreadyReceivedMAC = MailchimpAutomatedCampaignUser::whereUserId($this->user->id)
                    ->whereMailchimpAutomatedCampaignId($this->questionFlow->mailable->mailchimp_automated_campaign_id)
                    ->exists();

                if (! $memberAlreadyReceivedMAC || $this->questionFlow->mailable->mailchimpAutomatedCampaign->allow_multiple_emails) {
                    /** @var MailchimpAutomatedCampaignUser $mailchimpAutomatedCampaignUser */
                    $mailchimpAutomatedCampaignUser = $this->user->mailchimpAutomatedCampaignUser()->create([
                        'mailchimp_automated_campaign_id' => $this->questionFlow->mailable->mailchimp_automated_campaign_id,
                        'send_date'                       => Carbon::today(),
                        'status'                          => MailchimpAutomatedCampaignUser::STATUS_PENDING_VALIDATION,
                    ]);

                    $mailchimpAutomatedCampaignUser->send();
                }
            }
        }
    }
}
