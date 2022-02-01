<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToAutoRefinanceApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('auto_refinance_applications', function (Blueprint $table) {
            $table->boolean('completed_application')->nullable()->default(false)->after('ssn');
            $table->string('credit_score')->nullable()->after('ssn');
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
            $table->dropColumn('credit_score');
            $table->dropColumn('completed_application');
        });
    }
}
