<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Definitions\MenuTypes;

class CreateMenuLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_links', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('weight')->default(0);
            $table->string('menu');
            $table->integer('parent_id')->unsigned()->nullable();
            $table->text('href');
            $table->string('label');
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('menu_links');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_links');
    }
}
