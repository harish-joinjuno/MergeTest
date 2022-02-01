<?php

namespace App\Listeners;

use App\Providers\App\Events\QuestionFlowCompleted;
use App\QuestionFlowResponder;
use App\Traits\InteractsWithResponder;
use Illuminate\Contracts\Queue\ShouldQueue;

class MarkQuestionFlowResponderComplete
{
    use InteractsWithResponder;

    public $responderId;

    public $responderType;

    public function __construct()
    {
        list($responder_id, $responder_type) = $this->getResponderIdAndType();
        $this->responderId                   = $responder_id;
        $this->responderType                 = $responder_type;
    }

    /**
     * Handle the event.
     *
     * @param  QuestionFlowCompleted  $event
     * @return void
     */
    public function handle(QuestionFlowCompleted $event)
    {
        if ($event->questionFlow->started()) {
            /** @var QuestionFlowResponder $responder */
            $responder = $event->questionFlow->questionFlowResponders()
                ->where('responder_id', $this->responderId)
                ->where('responder_type', $this->responderType)
                ->first();

            $responder->completed_at = now();
            $responder->save();
        }
    }
}
