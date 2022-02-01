<?php

namespace App\Console\Commands\Imports;

use App\AccessTheDeal;
use App\Deal;
use App\DealStatus;
use App\DealStatusApplicability;
use App\Events\UpdateSociallyPowered;
use App\Mail\NotifyAdminOfEarnestBug;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class GetEarnestMetrics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get-metrics:earnest';

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
            'Clicked to Provider'      => DealStatus::CLICKED_TO_PROVIDER_ID,
            'SLR Application Submit'   => DealStatus::SUBMITTED_COMPLETE_APPLICATION,
            'SLR Application Approved' => DealStatus::APPROVED_BY_LENDER,
            'Student Loan Signature'   => DealStatus::SIGNED_THE_LOAN,
        ];

        $earnestRefiDeal               = Deal::where('slug',Deal::DEAL_EARNEST_REFINANCE_WITH_REWARDS_20_SLUG)->first();
        $earnestRefiDealStatusSequence = DealStatusApplicability::
            where('deal_id', $earnestRefiDeal->id)
            ->orderBy('sort_order','asc')
            ->pluck('deal_status_id')
            ->toArray();

        $earnestOtherRefiDeal               = Deal::where('slug',Deal::DEAL_EARNEST_REFINANCE_WITH_REWARDS_20_OTHER_STATES_SLUG)->first();
        $earnestOtherRefiDealStatusSequence = DealStatusApplicability::
            where('deal_id', $earnestOtherRefiDeal->id)
            ->orderBy('sort_order','asc')
            ->pluck('deal_status_id')
            ->toArray();

        $response = Http::get('https://IRNp693qTAsj2441308oF4FRC5FgtA5um1:NowBjgptWCKkr.N3GCisLTAJ%7Esvr4Zxj@api.impact.com/Mediapartners/IRNp693qTAsj2441308oF4FRC5FgtA5um1/Reports/mp_action_listing_sku_fast.json?SUPERSTATUS_MS=APPROVED&SUPERSTATUS_MS=NA&SUPERSTATUS_MS=PENDING&PUB_CAMPAIGN=9109&PUB_ACTION_TRACKER_MS=0&MP_ACTION_TYPE=0&ADV_PROMOCODE=0&ACTION_ID=0&SHOW_STATUS_DETAIL=1&SHOW_SKU=1&SHOW_LOCKING_DATE=1&SHOW_SHAREDID=1&SHOW_CUSTOMER_ID=1&SHOW_REFERRAL_DATE=1&SHOW_PROPERTY_ID=1&SHOW_ORIGINAL_SALEAMOUNT=1&SHOW_PROPERTY_TYPE=1&SHOW_PROPERTY_NAME=1&START_DATE=' . now()->subDays(90)->format('Y-m-d') . '&END_DATE=' . now()->format('Y-m-d') . '&timeRange=THIRTY&compareEnabled=false');

        if ($response->ok()) {
            if ($response->offsetExists('Records')) {

                // Get the Shared ID and Access The Deal Record
                foreach ($response["Records"] as $earnestRecord) {
                    if ($earnestRecord['Campaign'] != "Earnest") {
                        continue;
                    }

                    /** @var AccessTheDeal $accessTheDeal */
                    $accessTheDeal = AccessTheDeal::find((integer)$earnestRecord['Sharedid']);

                    if ($accessTheDeal && in_array($accessTheDeal->deal_id,[9,10])  ) {
                        $earnestStatus  = $map[$earnestRecord['Action_Tracker']];

                        if ($accessTheDeal->deal_id == $earnestRefiDeal->id) {
                            if ($accessTheDeal->user->email === User::SOCIALLY_POWERED_EMAIL) {
                                event(new UpdateSociallyPowered($accessTheDeal->user, $accessTheDeal));
                            }
                            $sequence = $earnestRefiDealStatusSequence;
                        } else {
                            if ($accessTheDeal->deal_id == $earnestOtherRefiDeal->id) {
                                $sequence = $earnestOtherRefiDealStatusSequence;
                            } else {
                                continue;
                            }
                        }

                        $earnestOrder   = array_search($earnestStatus, $sequence);
                        $existingOrder  = array_search($accessTheDeal->loan_status_id, $sequence);

                        if ($earnestOrder >= $existingOrder) {
                            switch ($earnestStatus) {
                                case DealStatus::SUBMITTED_COMPLETE_APPLICATION:
                                    $accessTheDeal->applied_on = substr($earnestRecord['Action_Date'],0,10);

                                    break;

                                case DealStatus::SIGNED_THE_LOAN:
                                    $accessTheDeal->signed_on        = substr($earnestRecord['Action_Date'],0,10);
                                    $accessTheDeal->disbursed_amount = $earnestRecord['Sale_Amount'];

                                    break;

                                default:
                                    break;
                            }

                            $accessTheDeal->loan_status_id = $earnestStatus;
                            if ($earnestRecord['Sale_Amount'] > 0) {
                                $accessTheDeal->loan_amount    = $earnestRecord['Sale_Amount'];
                            }
                            $accessTheDeal->save();
                        }

                        if (is_null($accessTheDeal->applied_on)) {
                            if ( $earnestStatus  ==  DealStatus::SUBMITTED_COMPLETE_APPLICATION ) {
                                $accessTheDeal->applied_on = substr($earnestRecord['Action_Date'], 0, 10);
                                $accessTheDeal->save();
                            }
                        }

                        if (is_null($accessTheDeal->signed_on)) {
                            if ( $earnestStatus  ==  DealStatus::SIGNED_THE_LOAN ) {
                                $accessTheDeal->signed_on = substr($earnestRecord['Action_Date'], 0, 10);
                                $accessTheDeal->save();
                            }
                        }
                    }
                }
            }
        } else {
            Mail::to('nikhil@leveredge.org')
                ->send(new NotifyAdminOfEarnestBug());
        }
    }
}
