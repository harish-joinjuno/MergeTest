<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTypeToDegreesTable extends Migration
{

    public function up()
    {
        Schema::table('degrees', function (Blueprint $table) {
            $table->renameColumn('degree_type', 'type');
        });
    }

    public function down()
    {
        Schema::table('degrees', function (Blueprint $table) {
            $table->renameColumn('type', 'degree_type');
        });
    }
}
