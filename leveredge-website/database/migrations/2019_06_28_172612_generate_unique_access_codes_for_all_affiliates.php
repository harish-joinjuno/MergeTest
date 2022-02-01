<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GenerateUniqueAccessCodesForAllAffiliates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $affiliates = DB::table('affiliates')->get();

        foreach ($affiliates as $affiliate) {


            // Generate a unique random affiliate access code
            $access_code = \Illuminate\Support\Str::random(8);

            // Iterate until we know that the code is unique in the database
            while (DB::table('affiliates')->where('access_code', $access_code)->exists()) {
                $access_code = \Illuminate\Support\Str::random(8);
            }

            // Add the Code to the Affiliate and Update the Database
            $affiliate->access_code = $access_code;
            $affiliate->save();

        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $affiliates = DB::table('affiliates')->get();

        foreach ($affiliates as $affiliate) {
            $affiliate->access_code = null;
            $affiliate->save();
        }


    }
}
