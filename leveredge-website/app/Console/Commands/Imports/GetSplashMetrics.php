<?php

namespace App\Console\Commands\Imports;

use App\AccessTheDeal;
use App\Deal;
use App\DealStatus;
use App\DealStatusApplicability;
use App\Events\UpdateSociallyPowered;
use App\Mail\NotifyAdminOfSplashBug;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class GetSplashMetrics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get-metrics:splash';

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
        $map = [
            'Clicked to Provider'       => DealStatus::CLICKED_TO_PROVIDER_ID,
            'Account Created'           => DealStatus::STARTED_APPLICATION,
            'Check My Rate Submission'  => DealStatus::RECEIVED_PRELIMINARY_QUOTES_ID,
            'Application Submit'        => DealStatus::SUBMITTED_COMPLETE_APPLICATION,
            'Closed Loan'               => DealStatus::SIGNED_THE_LOAN,
        ];

        $splashDealStatusSequence = DealStatusApplicability::
            where('deal_id', Deal::where('slug',Deal::DEAL_SPLASH_REFINANCE_SLUG)->first()->id)
            ->orderBy('sort_order','asc')
            ->pluck('deal_status_id')
            ->toArray();

        $response = Http::get('https://IRNp693qTAsj2441308oF4FRC5FgtA5um1:NowBjgptWCKkr.N3GCisLTAJ%7Esvr4Zxj@api.impact.com/Mediapartners/IRNp693qTAsj2441308oF4FRC5FgtA5um1/Reports/mp_action_listing_sku_fast.json?SUPERSTATUS_MS=APPROVED&SUPERSTATUS_MS=NA&SUPERSTATUS_MS=PENDING&PUB_CAMPAIGN=0&PUB_ACTION_TRACKER_MS=0&MP_ACTION_TYPE=0&ADV_PROMOCODE=0&ACTION_ID=0&SHOW_STATUS_DETAIL=1&SHOW_SKU=1&SHOW_LOCKING_DATE=1&SHOW_SHAREDID=1&SHOW_CUSTOMER_ID=1&SHOW_REFERRAL_DATE=1&SHOW_PROPERTY_ID=1&SHOW_ORIGINAL_SALEAMOUNT=1&SHOW_PROPERTY_TYPE=1&SHOW_PROPERTY_NAME=1&START_DATE=' . now()->subDays(90)->format('Y-m-d') . '&END_DATE=' . now()->format('Y-m-d') . '&timeRange=THIRTY&compareEnabled=false');

        if ($response->ok()) {
            if ($response->offsetExists('Records')) {

                // Get the Shared ID and Access The Deal Record
                foreach ($response["Records"] as $splashRecord) {
                    if ($splashRecord['Campaign'] != "Splash Financial") {
                        continue;
                    }

                    /** @var AccessTheDeal $accessTheDeal */
                    $accessTheDeal = AccessTheDeal::find((integer)$splashRecord['Sharedid']);

                    if ($accessTheDeal && $accessTheDeal->deal_id == 13) {
                        if ($accessTheDeal->user->email === User::SOCIALLY_POWERED_EMAIL) {
                            event(new UpdateSociallyPowered($accessTheDeal->user, $accessTheDeal));
                        }
                        $splashStatus  = $map[$splashRecord['Action_Tracker']];
                        $splashOrder   = array_search($splashStatus, $splashDealStatusSequence);
                        $existingOrder = array_search($accessTheDeal->loan_status_id, $splashDealStatusSequence);

                        if ($splashOrder >= $existingOrder) {
                            if ($splashStatus == DealStatus::RECEIVED_PRELIMINARY_QUOTES_ID) {
                                if ($splashRecord['Category'] == 'denied' || $splashRecord['Category'] == 'soft-denied' ) {
                                    $splashStatus = DealStatus::REJECTED_BY_LENDER;
                                }
                            }

                            switch ($splashStatus) {
                                case DealStatus::SUBMITTED_COMPLETE_APPLICATION:
                                    $accessTheDeal->applied_on = substr($splashRecord['Action_Date'],0,10);

                                    break;

                                case DealStatus::SIGNED_THE_LOAN:
                                    $accessTheDeal->signed_on = substr($splashRecord['Action_Date'],0,10);

                                    break;

                                default:
                                    break;
                            }

                            $accessTheDeal->loan_status_id = $splashStatus;
                            if ($splashRecord['Sale_Amount'] > 0) {
                                $accessTheDeal->loan_amount    = $splashRecord['Sale_Amount'];
                            }

                            $accessTheDeal->save();
                        }
                    }
                }
            }
        } else {
            Mail::to('nikhil@leveredge.org')
                ->send(new NotifyAdminOfSplashBug());
        }
    }
}
