<?php

namespace App\Events;

use App\AccessTheDeal;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdateSociallyPowered
{
    use Dispatchable, SerializesModels;

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
