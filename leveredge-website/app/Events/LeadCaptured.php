<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;

class LeadCaptured
{
    use Dispatchable;

    public $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }
}
