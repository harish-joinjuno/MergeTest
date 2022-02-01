<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNegotiationGroupFaqCategoriesTable extends Migration
{

    public function up()
    {
        Schema::create('negotiation_group_faq_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('negotiation_group_id');
            $table->string('name', 256);
            $table->timestamps();

            $table->foreign('negotiation_group_id')->references('id')->on('negotiation_groups')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('negotiation_group_faq_categories');
    }
}
