<?php

namespace App\Listeners;

use App\Facades\Mailchimp;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;

class SubscribeUserInMailchimp implements ShouldQueue
{
    public function handle(Registered $event)
    {
        return Mailchimp::subscribe($event->user->email, [], ['lead', 'registration_complete']);
    }
}
