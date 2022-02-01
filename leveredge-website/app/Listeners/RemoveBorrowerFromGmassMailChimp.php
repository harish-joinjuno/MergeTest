<?php

namespace App\Listeners;

use App\Facades\Mailchimp;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;

class RemoveBorrowerFromGmassMailChimp implements ShouldQueue
{
    public function handle(Registered $event)
    {
        $listId = config('services.mailchimp.gmass_list_id');
        Mailchimp::unsubscribe($event->user->email, $listId);
    }
}
