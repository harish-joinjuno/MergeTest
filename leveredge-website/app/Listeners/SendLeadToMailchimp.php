<?php

namespace App\Listeners;

use App\Events\LeadCaptured;
use App\Facades\Mailchimp;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendLeadToMailchimp implements ShouldQueue
{
    public function handle(LeadCaptured $event)
    {
        Mailchimp::subscribe($event->email, [], ['lead']);
    }
}
