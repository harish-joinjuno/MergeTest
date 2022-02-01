<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSsnToAutoRefinanceApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('auto_refinance_applications', function (Blueprint $table) {
            $table->string('ssn')->nullable()->after('work_duration');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('auto_refinance_applications', function (Blueprint $table) {
            $table->dropColumn('ssn');
        });
    }
}
