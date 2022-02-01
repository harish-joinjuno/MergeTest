<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class RemoveSelfReferralsFromTable extends Migration
{
    public function up()
    {
        $affiliates = DB::table('affiliates')->get();

        foreach ($affiliates as $affiliate) {
            if ($affiliate->id == $affiliate->referred_by_id) {
                $affiliate->referred_by_id = null;
                $affiliate->save();
            }
        }
    }

    public function down()
    {

    }
}
