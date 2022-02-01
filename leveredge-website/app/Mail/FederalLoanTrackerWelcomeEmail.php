<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FederalLoanTrackerWelcomeEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $subject = 'Thanks for signing up for updates!';

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.federal-loan-tracker.welcome');
    }
}
