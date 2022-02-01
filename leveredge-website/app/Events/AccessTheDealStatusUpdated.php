<?php

namespace App\Events;

use App\AccessTheDeal;
use App\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AccessTheDealStatusUpdated implements ShouldQueue
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;

    public $accessTheDeal;

    /**
     * Create a new event instance.
     *
     * @param User $user
     * @param AccessTheDeal $accessTheDeal
     */
    public function __construct(User $user, AccessTheDeal $accessTheDeal)
    {
        $this->user          = $user;
        $this->accessTheDeal = $accessTheDeal;
    }
}
