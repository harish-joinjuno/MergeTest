<?php

namespace App\Console\Commands;

use App\FederalLoanTrackerEmail;
use App\Jobs\SyncScholarshipEntrantWithMailcoachJob;
use Illuminate\Console\Command;

class SyncFederalLoanTrackerSubscribersWithMailcoach extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:mailcoach-federal';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        FederalLoanTrackerEmail::all()->each(function ($federalLoanTrackerEmail) {
            $federalSubscriberId = config('services.mailcoach_email.federal_tracker_list_id');
            dispatch(new SyncScholarshipEntrantWithMailcoachJob($federalLoanTrackerEmail, $federalSubscriberId));
        });
    }
}
