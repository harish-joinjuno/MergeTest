<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveUnusedTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('actions');
        Schema::dropIfExists('action_user');
        Schema::dropIfExists('fall_twenty_nineteen_inschool_surveys');
        Schema::dropIfExists('inflations');
        Schema::dropIfExists('leader_updates');
        Schema::dropIfExists('lenders');
        Schema::dropIfExists('negotiation_group_user');
        Schema::dropIfExists('negotiation_groups');
        Schema::dropIfExists('polls');
        Schema::dropIfExists('spring_twenty_nineteen_refinance_surveys');
        Schema::dropIfExists('votes');
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
