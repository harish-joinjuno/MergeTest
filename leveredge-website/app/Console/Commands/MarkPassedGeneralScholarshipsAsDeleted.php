<?php

namespace App\Console\Commands;

use App\CareerOneStopScholarship;
use Carbon\Carbon;
use Illuminate\Console\Command;

class MarkPassedGeneralScholarshipsAsDeleted extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'general-scholarships:prune';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mark all passed general scholarships as deleted';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $scholarships = CareerOneStopScholarship::all();

        $scholarships->each(function (CareerOneStopScholarship $scholarship) {
            if ($scholarship->formatted_deadline) {
                $date = Carbon::createFromFormat('F d, Y', $scholarship->formatted_deadline);

                if ($date->isBefore(today())) {
                    $scholarship->delete();
                }
            }
        });
    }
}
