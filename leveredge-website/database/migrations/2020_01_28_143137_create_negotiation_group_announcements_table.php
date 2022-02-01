<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNegotiationGroupAnnouncementsTable extends Migration
{

    public function up()
    {
        Schema::create('negotiation_group_announcements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('negotiation_group_id');

            $table->date('announced_on');
            $table->longText('body')->nullable();
            $table->longText('published_body')->nullable();

            $table->foreign('negotiation_group_id', 'negotiation_group_foreign')->references('id')->on('negotiation_groups')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('negotiation_group_academic_year_updates');
    }
}
