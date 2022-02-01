<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewRefinanceColumnsToUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->string('refinance_loan_type')->nullable();
            $table->boolean('is_currently_employed')->nullable();
            $table->boolean('have_job_start_date')->nullable();
            $table->date('job_start_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'refinance_loan_type',
                'is_currently_employed',
                'job_start_date',
            ]);
        });
    }
}
