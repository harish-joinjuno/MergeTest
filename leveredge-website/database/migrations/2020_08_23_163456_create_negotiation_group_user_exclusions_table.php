<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNegotiationGroupUserExclusionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('negotiation_group_user_exclusions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('negotiation_group_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();

            $table->foreign('negotiation_group_id')
                ->references('id')
                ->on('negotiation_groups')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('negotiation_group_user_exclusions');
    }
}
