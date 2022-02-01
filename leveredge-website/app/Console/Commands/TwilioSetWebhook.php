<?php

namespace App\Console\Commands;

use App\Facades\Sendgrid;
use App\Facades\Twilio;
use Illuminate\Console\Command;

class TwilioSetWebhook extends Command
{
    protected $signature = 'twilio:set-webhook';

    protected $description = 'Sets the twilio webhook';

    public function handle()
    {
        $twilioWebhook = twilioCallback();
        Twilio::updatePhoneNumberSmsWebhookUrl($twilioWebhook);
        $this->info("Twilio Webhook set to {$twilioWebhook}");
    }
}
