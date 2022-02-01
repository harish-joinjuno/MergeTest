<?php

namespace App\Console\Commands;

use App\MailchimpListCampaignReport;
use Illuminate\Console\Command;
use MailchimpMarketing\ApiClient;

class PullMailchimpListCapmaignReports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mailchimp:pull-list-reports';

    /**
     * The console command description.
     * @var string
     */
    protected $description = 'Pull mailchimp reports';

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

        $response = $mailchimpClient->reports->getAllCampaignReports(null, null, 1000);

        foreach ($response->reports as $report) {
            MailchimpListCampaignReport::updateOrCreate([
                    'campaign_title' => $report->campaign_title,
                    'list_id'        => $report->list_id
                ],[
                'report_id'                => $report->id,
                'campaign_title'           => $report->campaign_title,
                'type'                     => $report->type,
                'list_id'                  => $report->list_id,
                'list_is_active'           => $report->list_is_active,
                'list_name'                => $report->list_name,
                'subject_line'             => $report->subject_line,
                'preview_text'             => $report->preview_text,
                'emails_sent'              => $report->emails_sent,
                'abuse_reports'            => $report->abuse_reports,
                'unsubscribed'             => $report->unsubscribed,
                'hard_bounces'             => $report->bounces->hard_bounces,
                'soft_bounces'             => $report->bounces->soft_bounces,
                'syntax_errors'            => $report->bounces->syntax_errors,
                'forwards_count'           => $report->forwards->forwards_count,
                'forwards_opens'           => $report->forwards->forwards_opens,
                'opens_total'              => $report->opens->opens_total,
                'unique_opens'             => $report->opens->unique_opens,
                'open_rate'                => $report->opens->open_rate,
                'clicks_total'             => $report->clicks->clicks_total,
                'unique_clicks'            => $report->clicks->unique_clicks,
                'unique_subscriber_clicks' => $report->clicks->unique_subscriber_clicks,
                'click_rate'               => $report->clicks->click_rate,
            ]);
        }
    }
}
