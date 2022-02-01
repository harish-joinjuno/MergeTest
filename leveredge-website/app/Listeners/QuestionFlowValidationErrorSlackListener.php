<?php

namespace App\Listeners;

use App\Events\QuestionFlowValidationError;
use App\Notifications\QuestionFlowValidationSlackNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class QuestionFlowValidationErrorSlackListener implements ShouldQueue
{
    /**
    * Handle the event.
    *
    * @param  QuestionFlowValidationError  $event
    * @return void
    */
    public function handle(QuestionFlowValidationError $event)
    {
        Notification::route('slack', config('services.slack.question_flow_error_notification'))
            ->notify(new QuestionFlowValidationSlackNotification($event->errors, $event->failed, $event->inputs, $event->questionData, $event->userOrClient));
    }
}
