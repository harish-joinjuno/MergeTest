<?php

namespace App\Listeners;

use App\Jobs\IncompleteAbandonmentJob;
use Illuminate\Auth\Events\Registered;

class AbandonmentEmailsListener
{
    /**
     * Handle the event.
     *
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        dispatch(new IncompleteAbandonmentJob($event->user))->delay(now()->addHour());
    }
}
