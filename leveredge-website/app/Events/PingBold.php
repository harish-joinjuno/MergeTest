<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PingBold
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $subId1;

    /**
     * Create a new event instance.
     *
     * @param $subId1
     */
    public function __construct($subId1)
    {
        $this->subId1 = $subId1;
    }
}
