<?php

namespace App\Events;

use App\ScholarshipEntrant;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ScholarshipEntrantCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $scholarshipEntrant;

    public function __construct(ScholarshipEntrant $scholarshipEntrant)
    {
        $this->scholarshipEntrant = $scholarshipEntrant;
    }
}
