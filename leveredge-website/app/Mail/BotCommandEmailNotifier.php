<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BotCommandEmailNotifier extends Mailable
{
    use Queueable, SerializesModels;

    public $iias;

    /**
     * Create a new message instance.
     *
     * @param array $iias
     */
    public function __construct(array $iias)
    {
        $this->iias = $iias;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('IdentifyBot Command')
            ->view('emails.bot-command');
    }
}
