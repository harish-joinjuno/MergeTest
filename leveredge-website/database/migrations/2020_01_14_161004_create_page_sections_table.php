<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageSectionsTable extends Migration
{
    public function up()
    {
        Schema::create('page_sections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('target_page', 40);
            $table->string('section_name', 40);
            $table->longText('working_content')->nullable();
            $table->longText('published_content')->nullable();
            $table->dateTime('published_at')->nullable();
            $table->timestamps();

            $table->unique(['section_name', 'target_page']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('page_sections');
    }
}
