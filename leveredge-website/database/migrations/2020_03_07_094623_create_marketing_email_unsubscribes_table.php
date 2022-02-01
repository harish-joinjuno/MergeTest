<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketingEmailUnsubscribesTable extends Migration
{

    public function up()
    {
        Schema::create('marketing_email_unsubscribes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email');
            $table->boolean('has_unsubscribed')->default(1);
            $table->string('reason');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('marketing_email_unsubscribes');
    }
}
