<?php

namespace App\Jobs;

use App\Exceptions\MailchimpAutomatedCampaignException;
use App\Facades\Mailchimp;
use App\MailchimpAutomatedCampaignUser;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class MailchimpAutomatedCampaignEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $mailchimpAutomatedCampaignUser;

    /**
     * Create a new job instance.
     *
     * @param MailchimpAutomatedCampaignUser $mailchimpAutomatedCampaignUser
     */
    public function __construct(MailchimpAutomatedCampaignUser $mailchimpAutomatedCampaignUser)
    {
        $this->mailchimpAutomatedCampaignUser = $mailchimpAutomatedCampaignUser;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Redis::throttle('mailchimp-api')->allow(50)->every(2)->then(function () {
            $endpoints = $this->mailchimpAutomatedCampaignUser->mailchimpAutomatedCampaign->endpoints;
            $randEndpointKey = array_rand($endpoints, 1);
            $endpoint = $endpoints[$randEndpointKey];
            if (! App::environment('production')) {
                $client = new Client();
                $response = $client->post($endpoint, [
                    'json' => [
                        'email' => $this->mailchimpAutomatedCampaignUser->user->email,
                    ],
                ]);
                Log::info(json_encode($response));
            } else {
                try {
                    Mailchimp::addMembersToAutomationCampaignQueue(
                        $endpoint,
                        $this->mailchimpAutomatedCampaignUser->user->email);
                } catch (MailchimpAutomatedCampaignException $e) {
                    $this->mailchimpAutomatedCampaignUser->response = $e->getError();
                    $this->mailchimpAutomatedCampaignUser->save();
                }
            }

            $this->mailchimpAutomatedCampaignUser->status = MailchimpAutomatedCampaignUser::STATUS_CALL_SENT;
            $this->mailchimpAutomatedCampaignUser->save();
        }, function () {
            return $this->release(10);
        });
    }
}
