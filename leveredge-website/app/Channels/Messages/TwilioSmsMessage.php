<?php

namespace App\Channels\Messages;

class TwilioSmsMessage
{
    public $to;

    public $body;

    public function body(string $body)
    {
        $this->body = $body;

        return $this;
    }

    public function to(string $to)
    {
        $this->to = $to;

        return $this;
    }
}
