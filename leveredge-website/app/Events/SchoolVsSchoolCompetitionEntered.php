<?php

namespace App\Events;

use App\SchoolVsSchoolCompetitionEntrant;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SchoolVsSchoolCompetitionEntered
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $entrant;

    public function __construct(SchoolVsSchoolCompetitionEntrant $entrant)
    {
        $this->entrant = $entrant;
    }
}
