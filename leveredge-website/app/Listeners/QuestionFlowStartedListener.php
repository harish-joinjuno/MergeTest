<?php

namespace App\Listeners;

use App\Jobs\QuestionFlowAbandonmentEmailJob;
use App\Providers\App\Events\QuestionFlowStarted;

class QuestionFlowStartedListener
{
    /**
     * Handle the event.
     *
     * @param  QuestionFlowStarted  $event
     * @return void
     */
    public function handle(QuestionFlowStarted $event)
    {
        if ($event->user) {
            dispatch(new QuestionFlowAbandonmentEmailJob($event->questionFlow, $event->user))->delay(now()->addHour());
        }
    }
}
