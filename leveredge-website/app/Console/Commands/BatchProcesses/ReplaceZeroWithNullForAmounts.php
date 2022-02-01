<?php

namespace App\Console\Commands\BatchProcesses;

use App\AccessTheDeal;
use Illuminate\Console\Command;

class ReplaceZeroWithNullForAmounts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'replace-zero-with-null-for-amounts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        AccessTheDeal::where('loan_amount',0)->update(['loan_amount' => null]);
        AccessTheDeal::where('disbursed_amount',0)->update(['disbursed_amount' => null]);
    }
}
