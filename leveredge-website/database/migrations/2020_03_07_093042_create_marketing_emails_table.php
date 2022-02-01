<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketingEmailsTable extends Migration
{

    public function up()
    {
        Schema::create('marketing_emails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('marketing_email_template_id');
            $table->string('name')->nullable();
            $table->string('email_address');
            $table->date('send_date');
            $table->string('status')->nullable();
            $table->unsignedInteger('open')->nullable();
            $table->unsignedInteger('click')->nullable();
            $table->timestamps();

            $table->foreign('marketing_email_template_id')->references('id')
                ->on('marketing_email_templates')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('marketing_emails');
    }
}
