<?php

namespace App\Console\Commands\BatchProcesses;

use App\AccessTheDeal;
use App\DealStatus;
use Illuminate\Console\Command;

class ComputeRevenueMetrics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'compute-metrics:revenue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculates Gross and Net Revenue. Stores it in the access the deal database';

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
        $dealsWithoutRevenue = AccessTheDeal::where('loan_status_id',DealStatus::SIGNED_THE_LOAN)
            ->orWhere(function($query) {
                $query
                    ->whereNull('net_revenue')
                    ->whereNull('gross_revenue')
                    ->where('net_revenue', 0)
                    ->where('gross_revenue', 0);
            })
            ->get();

        foreach ($dealsWithoutRevenue as $accessTheDeal) {
            /** @var AccessTheDeal $accessTheDeal */
            $accessTheDeal->gross_revenue = $accessTheDeal->calculateGrossRevenue();
            $accessTheDeal->net_revenue   = $accessTheDeal->calculateNetRevenue();
            $accessTheDeal->save();
        }
    }
}
