<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemovePaymentFieldsFromLeveredgeRewardClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leveredge_reward_claims', function (Blueprint $table) {
            $table->dropForeign('leveredge_reward_claims_payment_record_id_foreign');
            $table->dropColumn([
                'payment_id',
                'payment_completed',
                'payment_record_id',
                'status',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leveredge_reward_claims', function (Blueprint $table) {
            $table->unsignedInteger('payment_id');
            $table->boolean('payment_completed');
            $table->unsignedBigInteger('payment_record_id')->nullable();
            $table->foreign('payment_record_id')->references('id')->on('payments')
                ->onUpdate('restrict')->onDelete('restrict');
            $table->string('status')->nullable();
        });
    }
}
