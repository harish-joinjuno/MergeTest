<?php

namespace App\Providers\App\Events;

use App\QuestionFlow;
use App\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class QuestionFlowStarted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $questionFlow;

    public $user;

    public function __construct(QuestionFlow  $questionFlow, User $user = null)
    {
        $this->questionFlow = $questionFlow;
        $this->user         = $user;
    }

}
