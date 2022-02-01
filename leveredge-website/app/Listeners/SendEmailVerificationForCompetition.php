<?php

namespace App\Listeners;

use App\Events\SchoolVsSchoolCompetitionEntered;
use App\Mail\VerifyCompetitionEntrant;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailVerificationForCompetition implements ShouldQueue
{

    public function __construct()
    {

    }

    public function handle(SchoolVsSchoolCompetitionEntered $event)
    {
        Mail::to($event->entrant->email)->send(new VerifyCompetitionEntrant($event->entrant));
    }
}
