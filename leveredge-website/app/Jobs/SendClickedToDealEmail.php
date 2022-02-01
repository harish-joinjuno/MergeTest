<?php


namespace App\Jobs;

use App\Deal;
use App\MailchimpAutomatedCampaignUser;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendClickedToDealEmail implements ShouldQueue
{
    use Queueable, Dispatchable, InteractsWithQueue, SerializesModels;

    public $deal;

    public $user;

    public function __construct(Deal $deal)
    {
        $this->user = user();
        $this->deal = $deal;
    }

    public function handle()
    {
        if ($this->deal->mailable) {
            /** @var MailchimpAutomatedCampaignUser $mailchimpAutomatedCampaignUser */
            $mailchimpAutomatedCampaignUser = $this->user->mailchimpAutomatedCampaignUser()->create([
                'mailchimp_automated_campaign_id' => $this->deal->mailable->mailchimp_automated_campaign_id,
                'send_date'                       => Carbon::today(),
                'status'                          => MailchimpAutomatedCampaignUser::STATUS_PRE_DISPATCHING,
            ]);

            $mailchimpAutomatedCampaignUser->send();
        }
    }
}
