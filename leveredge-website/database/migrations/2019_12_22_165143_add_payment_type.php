<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaymentType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('campus_ambassador_tasks', function (Blueprint $table) {
            $table->integer('payment_type');
            $table->integer('fixed_payment_amount')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('campus_ambassador_tasks', function (Blueprint $table) {
            $table->dropColumn('payment_type');
            $table->dropColumn('fixed_payment_amount');
        });
    }
}
