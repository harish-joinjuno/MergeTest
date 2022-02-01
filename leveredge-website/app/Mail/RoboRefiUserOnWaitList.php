<?php

namespace App\Mail;

use App\RoboRefiUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RoboRefiUserOnWaitList extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $roboRefiUser;

    /**
     * Create a new message instance.
     *
     * @param RoboRefiUser $roboRefiUser
     */
    public function __construct(RoboRefiUser $roboRefiUser)
    {
        $this->roboRefiUser = $roboRefiUser;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Welcome')
            ->markdown('emails.robo-refi.joined-wait-list');
    }
}
