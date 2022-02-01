<?php

namespace App\Events;

use App\Client;
use App\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class QuestionFlowValidationError
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $errors;

    public $failed;

    public $inputs;

    public $questionData;

    public $userOrClient;

    /**
     * Create a new event instance.
     *
     * @param array $errors
     * @param array $failed
     * @param array $inputs
     * @param array $questionData
     * @param User|Client $userOrClient
     */
    public function __construct(array $errors, array $failed, array $inputs, array $questionData, $userOrClient)
    {
        $this->errors       = $errors;
        $this->failed       = $failed;
        $this->inputs       = $inputs;
        $this->questionData = $questionData;
        $this->userOrClient = $userOrClient;
    }
}
