<?php

namespace App\Jobs;

use App\Mail\SchoolVSchoolShareViaEmail;
use App\SchoolVsSchoolCompetitionEntrant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SchoolVSchoolShareViaEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $entrant;

    public $emails;

    /**
     * Create a new job instance.
     *
     * @param SchoolVsSchoolCompetitionEntrant $entrant
     * @param array $emails
     */
    public function __construct(SchoolVsSchoolCompetitionEntrant $entrant, array $emails)
    {
        $this->entrant = $entrant;
        $this->emails  = $emails;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->emails as $email) {
            Mail::to($email)->send(new SchoolVSchoolShareViaEmail($this->entrant));
        }
    }
}
