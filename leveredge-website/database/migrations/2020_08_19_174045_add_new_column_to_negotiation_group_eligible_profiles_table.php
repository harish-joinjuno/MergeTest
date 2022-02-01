<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnToNegotiationGroupEligibleProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('negotiation_group_eligible_profiles', function (Blueprint $table) {
            $table->boolean('has_graduated')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('negotiation_group_eligible_profiles', function (Blueprint $table) {
            $table->dropColumn('has_graduated');
        });
    }
}
