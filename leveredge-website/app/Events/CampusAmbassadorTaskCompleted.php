<?php

namespace App\Events;

use App\CompletedCampusAmbassadorTask;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CampusAmbassadorTaskCompleted
{
    use Dispatchable, SerializesModels;

    public $completedTask;

    public function __construct(CompletedCampusAmbassadorTask $completedTask)
    {
        $this->completedTask = $completedTask;
    }
}
