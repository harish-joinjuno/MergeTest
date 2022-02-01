<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterDegreesTableFixUniques extends Migration
{
    public function up()
    {
        Schema::table('degrees', function (Blueprint $table) {
            $table->dropUnique('degrees_name_unique');

            $table->unique(['name', 'degree_type']);
        });
    }

    public function down()
    {
        Schema::table('degrees', function (Blueprint $table) {
            $table->dropUnique('degrees_name_degree_type_unique');

            $table->unique('name');
        });
    }
}
