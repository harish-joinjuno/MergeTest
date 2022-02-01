<?php

namespace App\Events;

use App\BoldStudent;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewBoldStudent
{
    use Dispatchable, SerializesModels;

    public $boldStudent;

    public function __construct(BoldStudent $boldStudent)
    {
        $this->boldStudent = $boldStudent;
    }
}
