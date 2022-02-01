<?php

namespace App\Providers\App\Events;

use App\QuestionFlow;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class QuestionFlowCompleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $questionFlow;

    public function __construct(QuestionFlow  $questionFlow)
    {
        $this->questionFlow = $questionFlow;
    }
}
