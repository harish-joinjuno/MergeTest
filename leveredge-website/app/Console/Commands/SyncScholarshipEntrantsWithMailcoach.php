<?php

namespace App\Console\Commands;

use App\Jobs\SyncScholarshipEntrantWithMailcoachJob;
use App\ScholarshipEntrant;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class SyncScholarshipEntrantsWithMailcoach extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:mailcoach-entrants';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync scholarship entrants with mailcoach subscribers list ID 3 (Scholarships - Entire)';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        ScholarshipEntrant::orderBy('id')
            ->chunk(200, function ($entrants) {
                $entrants->each(function (ScholarshipEntrant $entrant) {
                    $listId = config('services.mailcoach_email.scholarship_list_id');
                    dispatch(new SyncScholarshipEntrantWithMailcoachJob($entrant, $listId, ScholarshipEntrant::MAILCOACH_TAGS));
                });
            });
    }
}
