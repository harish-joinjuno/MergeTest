<?php

namespace App\Console\Commands;

use App\MailchimpCampaign;
use Illuminate\Console\Command;
use MailchimpMarketing\ApiClient;

class PullMailchimpCampaigns extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mailchimp:pull-campaigns';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pull mailchimp campaigns';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $mailchimpClient = new ApiClient();
        $mailchimpClient->setConfig([
            'apiKey' => config('services.mailchimp.api_key'),
            'server' => config('services.mailchimp.server_prefix'),
        ]);

        $response = $mailchimpClient->campaigns->list(null, null, 1000);

        foreach ($response->campaigns as $campaign) {
            $data = [
                'campaign_id' => $campaign->id,
                'title'       => $campaign->settings->title,
            ];

            MailchimpCampaign::firstOrCreate($data, $data);
        }
    }
}
