<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaymentToAmbassadorTaskPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('campus_ambassador_task_user', function (Blueprint $table) {
            $table->integer('payment')->nullable();
            $table->text('ambassador_notes')->nullable();
            $table->text('admin_notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('campus_ambassador_task_user', function (Blueprint $table) {
            $table->dropColumn('payment');
            $table->dropColumn('ambassador_notes');
            $table->dropColumn('admin_notes');
        });
    }
}
