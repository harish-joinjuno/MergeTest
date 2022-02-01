<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNegotationGroupUserLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('negotiation_group_user_leaves', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('negotiation_group_user_id');
            $table->foreign('negotiation_group_user_id', 'negotiation_group_user_leaves_ngu_id')->references('id')->on('negotiation_group_users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->text('reason');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('negotiation_group_user_leaves');
    }
}
