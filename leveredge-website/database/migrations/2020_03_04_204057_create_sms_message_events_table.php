<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsMessageEventsTable extends Migration
{
    public function up()
    {
        Schema::create('sms_message_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sms_message_id');
            $table->string('twilio_id', 128)->index()->comment('Twilio event id');
            $table->string('status', 32);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('sms_message_id')->references('id')->on('sms_messages')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sms_message_events');
    }
}
