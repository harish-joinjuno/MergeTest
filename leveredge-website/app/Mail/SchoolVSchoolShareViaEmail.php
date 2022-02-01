<?php

namespace App\Mail;

use App\SchoolVsSchoolCompetitionEntrant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SchoolVSchoolShareViaEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $entrant;

    /**
     * Create a new message instance.
     *
     * @param SchoolVsSchoolCompetitionEntrant $entrant
     */
    public function __construct(SchoolVsSchoolCompetitionEntrant $entrant)
    {
        $this->entrant = $entrant;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $rival = $this->entrant->competition->colloquial_name_two;

        return $this->subject($this->entrant->first_name . ' needs your help to beat ' . $rival)
            ->cc($this->entrant->email)
            ->view('emails.school-v-school-share-via-email')
            ->with([
                'competition' => $this->entrant->competition,
                'email'       => $this->entrant->email,
            ]);
    }
}
