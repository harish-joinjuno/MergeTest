<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeveredgeRewardDistributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leveredge_reward_distributions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('leveredge_reward_claim_id');
            $table->unsignedBigInteger('payment_record_id')->nullable();
            $table->unsignedInteger('amount');
            $table->boolean('payment_completed')->default(false);
            $table->text('admin_notes')->nullable();
            $table->timestamps();

            $table->foreign('leveredge_reward_claim_id')->references('id')->on('leveredge_reward_claims')
                ->onUpdate('restrict')->onDelete('restrict');
            $table->foreign('payment_record_id')->references('id')->on('payments')
                ->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leveredge_reward_distributions');
    }
}
