<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJoinJunoMigrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('join_juno_migrations', function (Blueprint $table) {
            $table->id();
            $table->string('column');
            $table->string('resource_id');
            $table->string('resource');
            $table->string('model');
            $table->text('current');
            $table->text('suggested');
            $table->text('final_change');
            $table->text('affected_pages')->nullable();
            $table->boolean('is_changed')->default(false)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('join_juno_migrations');
    }
}
