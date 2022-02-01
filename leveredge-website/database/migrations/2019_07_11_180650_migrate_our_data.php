<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MigrateOurData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('affiliates', function (Blueprint $table) {
            $table->integer('referred_by_id')->nullable();
        });

        foreach (DB::table('affiliates')->get() as $affiliate) {

            // Retrieve Associated Records
            $inschool_table_record         = \App\InschoolSubscriber::where('email', $affiliate->email)->whereNotNull('affiliate')->first();
            $refinance_table_record        = \App\RefinanceSubscriber::where('email', $affiliate->email)->whereNotNull('affiliate')->first();
            $access_the_deal_table_records = \App\AccessTheDeal::where('email', $affiliate->email)->get();

            $potential_referrers = [];

            if ($inschool_table_record) {
                $inschool_referrer = DB::table('affiliates')->where('code', $inschool_table_record->affiliate)->first();
                if ($inschool_referrer) {
                    array_push($potential_referrers, [
                        'referred_by_id' => $inschool_referrer->id,
                        'referred_at'    => $inschool_table_record->created_at,
                    ]);
                }

            }

            if ($refinance_table_record) {
                $refinance_referrer = DB::table('affiliates')->where('code', $refinance_table_record->affiliate)->first();
                if ($refinance_referrer) {
                    array_push($potential_referrers, [
                        'referred_by_id' => $refinance_referrer->id,
                        'referred_at'    => $refinance_table_record->created_at,
                    ]);
                }
            }

            foreach ($access_the_deal_table_records as $access_the_deal_table_record) {
                // Check Referral by Access Code
                if ($access_the_deal_table_record->access_code != null) {
                    $access_the_deal_referrer = DB::table('affiliates')->where('access_code', $access_the_deal_table_record->access_code)->first();
                    if ($access_the_deal_referrer) {
                        array_push($potential_referrers, [
                            'referred_by_id' => $access_the_deal_referrer->id,
                            'referred_at'    => $access_the_deal_table_record->created_at,
                        ]);
                    }
                }

                // Check Affiliate Code Referral
                if ($access_the_deal_table_record->referred_by != null) {
                    $access_the_deal_referrer_two = DB::table('affiliates')->where('code', $access_the_deal_table_record->referred_by)->first();
                    if ($access_the_deal_referrer_two) {
                        array_push($potential_referrers, [
                            'referred_by_id' => $access_the_deal_referrer_two->id,
                            'referred_at'    => $access_the_deal_table_record->created_at,
                        ]);
                    }
                }
            }

            // Pick the Potential Referrer with the Earliest Date
            usort($potential_referrers, function ($a, $b) {
                return ($a['referred_at'] > $b['referred_at']);
            });

            // Select the Winning Referral
            if (count($potential_referrers) > 0) {
                $winning_referrer          = $potential_referrers[0];
                $affiliate->referred_by_id = $winning_referrer['referred_by_id'];
            } else {
                $affiliate->referred_by_id = null;
            }

            // Update the Database
            $affiliate->save();
        }
    }

    public function down()
    {
        Schema::table('affiliates', function (Blueprint $table) {
            $table->dropColumn('referred_by_id');
        });
    }
}
