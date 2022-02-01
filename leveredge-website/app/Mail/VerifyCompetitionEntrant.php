<?php

namespace App\Mail;

use App\SchoolVsSchoolCompetitionEntrant;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerifyCompetitionEntrant extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $entrant;

    public function __construct(SchoolVsSchoolCompetitionEntrant $entrant)
    {
        $this->entrant = $entrant;
    }

    public function build()
    {
        return $this->subject('Verify your Email Address')
            ->markdown('emails.school-vs-school-competition.verify-email-address');
    }
}
