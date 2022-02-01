<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandingPageTemplateFaqGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landing_page_template_faq_group', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('faq_group_id');
            $table->unsignedBigInteger('landing_page_template_id');
            $table->timestamps();

            $table->foreign('faq_group_id')->references('id')->on('faq_groups')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('landing_page_template_id')->references('id')->on('landing_page_templates')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('landing_page_template_faq_group');
    }
}
