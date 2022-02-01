<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsMessagesTable extends Migration
{

    public function up()
    {
        Schema::create('sms_messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('twilio_id', 128)->index()->comment('Twilio SMS sid');
            $table->boolean('incoming');
            $table->string('from', 32);
            $table->string('to', 32);
            $table->text('body')->nullable();
            $table->text('media')->nullable();
            $table->string('status', 32)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sms_messages');
    }
}
