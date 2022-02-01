<?php

namespace App\Jobs;

use App\MarketingEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class MarketingEmailCsvJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $filePath;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    public function handle()
    {
        $filePath = 'marketing-emails/' . $this->filePath;

        Storage::disk('local')->put($filePath, '');
        $storagePath = 'app/' . $filePath;

        $fp = fopen(storage_path($storagePath), 'w');

        fputcsv($fp, [
            'id',
            'marketing_email_template_id',
            'name',
            'email_address',
            'send_date',
            'status',
            'open',
            'click',
            'utm_source',
            'utm_campaign',
            'utm_medium',
            'utm_term',
            'utm_content',
            'fields'
        ]);
        MarketingEmail::orderBy('id')
            ->chunk(1000, function ($marketingEmails) use ($fp) {
                $marketingEmails->each(function ($marketingEmail) use ($fp) {
                    fputcsv($fp, [
                        $marketingEmail->id,
                        $marketingEmail->marketing_email_template_id,
                        $marketingEmail->name,
                        $marketingEmail->email_address,
                        $marketingEmail->send_date->format('Y-m-d'),
                        $marketingEmail->status,
                        $marketingEmail->open,
                        $marketingEmail->click,
                        $marketingEmail->utm_source,
                        $marketingEmail->utm_campaign,
                        $marketingEmail->utm_medium,
                        $marketingEmail->utm_term,
                        $marketingEmail->utm_content,
                        $marketingEmail->fields
                    ]);
                });
            });
    }
}
