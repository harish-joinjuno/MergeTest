<?php

namespace App\Listeners;

use App\Events\QuestionFlowValidationError;
use Illuminate\Contracts\Queue\ShouldQueue;

class QuestionFlowValidationErrorDatabaseListener implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  QuestionFlowValidationError  $event
     * @return void
     */
    public function handle(QuestionFlowValidationError $event)
    {
        $responseData = [];

        foreach ($event->errors as $field => $message) {
            $responseData[] = [
                'field'   => $field,
                'message' => $message[0],
                'input'   => isset($event->inputs[$field]) ? $event->inputs[$field] : 'EMPTY',
            ];
        }

        $event->userOrClient
            ->questionFlowValidationErrors()
            ->create([
                'question_flow_id' => $event->questionData['question_flow_id'],
                'question_page_id' => $event->questionData['question_page_id'],
                'response'         => $responseData,
            ]);
    }
}
