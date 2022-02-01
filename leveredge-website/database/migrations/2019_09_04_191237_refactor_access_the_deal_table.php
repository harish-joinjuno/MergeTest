<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RefactorAccessTheDealTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Add the User ID Column
        Schema::table('access_the_deals', function (Blueprint $table) {
            $table->integer('user_id')->default(0);
        });

        foreach(\App\AccessTheDeal::all() as $deal){
            // Find the User
            $user = \App\User::where('email',$deal->email)->first();

            // Link the Access the Deal Record
            $deal->user_id = $user->id;
            $deal->save();
        }

        // Drop the unnecessary information from the Access the Deal Table
        Schema::table('access_the_deals', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('email');
            $table->dropColumn('degree');
            $table->dropColumn('university');
            $table->dropColumn('access_code');
            $table->dropColumn('cosigner_status');
            $table->dropColumn('graduation_year');
            $table->dropColumn('job_queued');
            $table->dropColumn('referred_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
