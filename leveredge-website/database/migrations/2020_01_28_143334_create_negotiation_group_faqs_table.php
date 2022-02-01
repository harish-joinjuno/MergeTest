<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNegotiationGroupFaqsTable extends Migration
{

    public function up()
    {
        Schema::create('negotiation_group_faqs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('negotiation_group_faq_category_id');
            $table->string('title', 256);
            $table->longText('body')->nullable();
            $table->longText('published_body')->nullable();
            $table->dateTime('published_at')->nullable();
            $table->timestamps();

            $table->foreign('negotiation_group_faq_category_id')->references('id')->on('negotiation_group_faq_categories')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('negotiation_group_faqs');
    }
}
