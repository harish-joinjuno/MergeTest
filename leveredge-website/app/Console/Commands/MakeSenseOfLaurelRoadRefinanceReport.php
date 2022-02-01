<?php

namespace App\Console\Commands;

use App\AccessTheDeal;
use App\LaurelRoadRefinanceReport;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class MakeSenseOfLaurelRoadRefinanceReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'juno:make-sense-of-laurel-road-refinance-report';

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
        // Assign an Access The Deal ID Based on Url
        $reports = LaurelRoadRefinanceReport::where('url_upcase','like','%leveredgeid%')
            ->whereNull('access_the_deal_id')
            ->get();

        foreach ($reports as $report) {
            $report->access_the_deal_id = (int)Str::between($report->url_upcase,'LEVEREDGEID=','&');
            $report->save();
        }

        // Update Access The Deals Table When Possible
        $connectedReports = LaurelRoadRefinanceReport::whereNotNull('access_the_deal_id')->get();
        foreach ($connectedReports as $connectedReport) {
            /** @var AccessTheDeal $accessTheDeal */
            $accessTheDeal = AccessTheDeal::find($connectedReport->access_the_deal_id);
            if ($accessTheDeal && $accessTheDeal->deal_id == 14) {
                if ( is_null($accessTheDeal->applied_on) ) {
                    $accessTheDeal->applied_on = $connectedReport->application_date;
                    $accessTheDeal->save();
                }

                if (is_null($accessTheDeal->signed_on
                    && $connectedReport->los_stage == "closed_funded"
                    && !is_null($connectedReport->closing_date) )) {
                    $accessTheDeal->signed_on        = $connectedReport->closing_date;
                    $accessTheDeal->loan_amount      = $connectedReport->full_amount;
                    $accessTheDeal->disbursed_amount = $connectedReport->full_amount;
                    $accessTheDeal->save();
                }
            }
        }
    }
}
