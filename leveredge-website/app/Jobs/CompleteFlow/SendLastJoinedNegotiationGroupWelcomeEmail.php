<?php


namespace App\Jobs\CompleteFlow;

use App\MailchimpAutomatedCampaignUser;
use App\NegotiationGroupUser;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendLastJoinedNegotiationGroupWelcomeEmail implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public $user;

    public function __construct($user = null)
    {
        $this->user = $user ? $user : user();
    }

    public function handle()
    {
        /** @var NegotiationGroupUser $negotiationGroupUser */
        $negotiationGroupUser = NegotiationGroupUser::whereUserId($this->user->id)->orderBy('id','desc')->first();

        if ($negotiationGroupUser) {
            if ($negotiationGroupUser->negotiationGroup->mailable) {
                $memberAlreadyReceivedMAC = MailchimpAutomatedCampaignUser::whereUserId($this->user->id)
                    ->whereMailchimpAutomatedCampaignId($negotiationGroupUser->negotiationGroup->mailable->mailchimp_automated_campaign_id)
                    ->exists();

                if (! $memberAlreadyReceivedMAC || $negotiationGroupUser->negotiationGroup->mailable->mailchimpAutomatedCampaign->allow_multiple_emails) {
                    /** @var MailchimpAutomatedCampaignUser $mailchimpAutomatedCampaignUser */
                    $mailchimpAutomatedCampaignUser = $this->user->mailchimpAutomatedCampaignUser()->create([
                        'mailchimp_automated_campaign_id' => $negotiationGroupUser->negotiationGroup->mailable->mailchimp_automated_campaign_id,
                        'send_date'                       => Carbon::today(),
                        'status'                          => MailchimpAutomatedCampaignUser::STATUS_PENDING_VALIDATION,
                    ]);

                    $mailchimpAutomatedCampaignUser->send();
                }
            }
        }
    }
}
