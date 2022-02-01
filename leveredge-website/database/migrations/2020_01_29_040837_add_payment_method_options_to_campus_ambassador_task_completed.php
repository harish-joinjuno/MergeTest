<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentMethodOptionsToCampusAmbassadorTaskCompleted extends Migration
{
    public function up()
    {
        Schema::table('campus_ambassador_task_user', function (Blueprint $table) {
            $table->renameColumn('payment', 'amount');
            $table->unsignedBigInteger('campus_ambassador_task_id')->change();
            $table->unsignedBigInteger('payment_method_id')->after('campus_ambassador_task_id');
            $table->unsignedBigInteger('payment_record_id')->nullable()->after('payment_method_id');

            $table->foreign('campus_ambassador_task_id')->references('id')->on('campus_ambassador_tasks')->onDelete('restrict');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->onDelete('restrict');
            $table->foreign('payment_record_id')->references('id')->on('payments')->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::table('campus_ambassador_task_user', function (Blueprint $table) {
            $table->renameColumn('amount', 'payment');
            $table->dropForeign(['campus_ambassador_task_id']);
            $table->dropForeign(['payment_method_id']);
            $table->dropForeign(['payment_record_id']);
            $table->dropColumn(['payment_method_id', 'payment_record_id']);
        });
    }
}
