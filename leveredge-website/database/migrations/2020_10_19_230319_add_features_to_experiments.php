<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFeaturesToExperiments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('experiments', function (Blueprint $table) {
            $table->string('feature_one')->after('description')->nullable();
            $table->string('feature_two')->after('feature_one')->nullable();
            $table->string('feature_three')->after('feature_two')->nullable();
            $table->string('feature_four')->after('feature_three')->nullable();
            $table->string('feature_five')->after('feature_four')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('experiments', function (Blueprint $table) {
            $table->dropColumn('feature_one');
            $table->dropColumn('feature_two');
            $table->dropColumn('feature_three');
            $table->dropColumn('feature_four');
            $table->dropColumn('feature_five');
        });
    }
}
