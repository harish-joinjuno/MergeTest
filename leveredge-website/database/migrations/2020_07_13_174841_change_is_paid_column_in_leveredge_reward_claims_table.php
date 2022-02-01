<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeIsPaidColumnInLeveredgeRewardClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leveredge_reward_claims', function (Blueprint $table) {
            $table->dropColumn('is_paid');
            $table->boolean('payment_completed')->default(false)->after('status');
            $table->unsignedBigInteger('payment_record_id')->nullable()->after('status');
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
        Schema::table('leveredge_reward_claims', function (Blueprint $table) {
            $table->dropForeign('leveredge_reward_claims_payment_record_id_foreign');
            $table->dropColumn(['payment_completed', 'payment_record_id']);
            $table->boolean('is_paid');
        });
    }
}
