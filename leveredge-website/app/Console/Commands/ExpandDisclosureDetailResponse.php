<?php

namespace App\Console\Commands;

use App\DisclosureDetail;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class ExpandDisclosureDetailResponse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'juno:expand-disclosure-detail-response';

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
        /** @var DisclosureDetail[] $disclosureDetails */
        $disclosureDetails = DisclosureDetail::where('response_expanded',false)
            ->where(function(Builder $query) {
                $query->whereNull('response_has_error')->orWhere('response_has_error',false);
            })
            ->where('response_received',true)
            ->get();

        foreach ($disclosureDetails as $disclosureDetail) {
            $response           = $disclosureDetail->response;
            $availableKeys      = array_keys((array)$response);

            if (in_array('error',$availableKeys)) {
                $disclosureDetail->response_has_error = true;
                $disclosureDetail->save();

                continue;
            }

            $disclosureDetail->response_has_error = false;

            $stringKeys = [
                'document','creditor','borrower_name','cosigner_name',
            ];

            foreach ($stringKeys as $key) {
                if (in_array($key,$availableKeys)) {
                    $disclosureDetail->$key = $response->$key;
                }
            }

            // Save Floats
            $floatKeys = [
                'interest_rate','apr','finance_charge','total_payments','total_loan_amount',
            ];
            foreach ($floatKeys as $key) {
                if (in_array($key,$availableKeys)) {
                    $disclosureDetail->$key = floatval(preg_replace("/[^-0-9\.]/","",$response->$key));
                }
            }

            // Save Booleans
            $booleanKeys = [
              'right_to_cancel',
            ];
            foreach ($booleanKeys as $key) {
                if (in_array($key,$availableKeys)) {
                    if ( Str::contains( strtolower($response->$key) ,'yes') ) {
                        $disclosureDetail->$key = true;
                    }

                    if ( Str::contains($response->interest_rate_type,'no') ) {
                        $disclosureDetail->$key = false;
                    }
                }
            }

            // Save Dates
            $dateKeys = [
              'right_to_cancel_date',
            ];
            foreach ($dateKeys as $key) {
                if (in_array($key,$availableKeys)) {
                    $disclosureDetail->$key = new Carbon($response->$key);
                }
            }

            // Save Rate Type
            if (in_array('interest_rate_type',$availableKeys)) {
                if ( Str::contains( strtolower($response->interest_rate_type) ,'var') ) {
                    $disclosureDetail->rate_type = 'variable';
                }

                if ( Str::contains( strtolower($response->interest_rate_type),'fix') ) {
                    $disclosureDetail->rate_type = 'fixed';
                }
            }

            // Save Loan Term
            if (in_array('loan_term',$availableKeys)) {
                $disclosureDetail->loan_term = (int)$response->loan_term;

                if ( Str::contains(strtolower($response->loan_term),['yr','year']) ) {
                    $disclosureDetail->loan_term = $disclosureDetail->loan_term*12;
                }
            }

            $disclosureDetail->response_expanded = true;
            $disclosureDetail->save();
        }

        return 0;
    }
}
