<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropGoogleOptimizeRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('google_optimize_routes');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('google_optimize_routes', function (Blueprint $table) {
            $table->id();
            $table->string('route');
            $table->softDeletes();
            $table->timestamps();
        });
    }
}
