<?php

namespace App\Console\Commands\BatchProcesses;

use App\AccessTheDeal;
use App\Deal;
use Illuminate\Console\Command;

class SetEstimatedLoanAmounts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'set-estimated-loan-amounts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sets the estimated loan amounts for each deal';

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
        foreach (Deal::all() as $deal) {
            $average = AccessTheDeal::whereNotNull('loan_amount')
                ->where('loan_amount','>',10)
                ->where('deal_id',$deal->id)
                ->orderBy('id','desc')
                ->take(20)
                ->get()
                ->avg('loan_amount');

            $deal->estimated_loan_amount = $average ? $average : 0;
            $deal->save();
        }
    }
}
