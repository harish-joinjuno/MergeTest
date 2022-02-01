<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveNullableFromTuitionDueDateInTuitionDueDateProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tuition_due_date_programs', function (Blueprint $table) {
            $table->date('tuition_due_date')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tuition_due_date_programs', function (Blueprint $table) {
            $table->date('tuition_due_date')->nullable(true)->change();
        });
    }
}
