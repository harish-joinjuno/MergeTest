<?php

namespace App\Listeners;

use App\Facades\Mailchimp;
use Illuminate\Contracts\Queue\ShouldQueue;

class SubscribeBoldStudentToMailChimp implements ShouldQueue
{
    public function handle($event)
    {
        return Mailchimp::subscribe($event->boldStudent->email, ['FNAME' => $event->boldStudent->full_name], ['bold_org_lead']);
    }
}
