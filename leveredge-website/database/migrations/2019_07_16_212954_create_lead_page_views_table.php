<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadPageViewsTable extends Migration
{
    public function up()
    {
        Schema::create('lead_page_views', function (Blueprint $table) {
            $table->increments('id');
            $table->string('session_id');
            $table->integer('lead_id');
            $table->string('page');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lead_page_views');
    }
}
