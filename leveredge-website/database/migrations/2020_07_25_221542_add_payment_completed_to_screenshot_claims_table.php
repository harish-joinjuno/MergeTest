<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentCompletedToScreenshotClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('screenshot_claims', function (Blueprint $table) {
            $table->dropColumn('is_paid');
            $table->boolean('payment_completed')->after('status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('screenshot_claims', function (Blueprint $table) {
            $table->dropColumn('payment_completed');
            $table->boolean('is_paid')->default(0);
        });
    }
}
