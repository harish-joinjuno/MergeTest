<?php

namespace App\Jobs;

use App\Mail\MarketingEmail as MarketingEmailMail;
use App\MarketingEmail;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class SendMarketingEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $marketingEmail;

    public function __construct(MarketingEmail $marketingEmail)
    {
        $this->marketingEmail = $marketingEmail;
    }

    public function handle()
    {
        Redis::throttle('send-marketing-emails')
            ->allow(10)
            ->every(5)
            ->then(function () {
                $subject = Str::replaceFirst('{{first_name}}', $this->marketingEmail->first_name, $this->marketingEmail->marketingEmailTemplate->subject);
                Mail::to(trim($this->marketingEmail->email_address))
                    ->send(new MarketingEmailMail($this->marketingEmail, $subject));
                $this->marketingEmail->setStatus(MarketingEmail::MAIL_SENT);
            }, function () {
                $this->release(60);
            });
    }

    public function retryUntil()
    {
        return now()->addHours(2);
    }
}
