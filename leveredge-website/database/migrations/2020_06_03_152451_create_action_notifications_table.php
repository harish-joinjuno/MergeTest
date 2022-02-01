<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionNotificationsTable extends Migration
{
    public function up()
    {
        Schema::create('action_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('description');
            $table->string('cta_text')->nullable();
            $table->string('cta_link')->nullable();
            $table->string('icon')->nullable();
            $table->string('notification_style');
            $table->unsignedInteger('sort_order');
            $table->string('visibility_rule');
            $table->string('dismissable_rule')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('action_notifications');
    }
}
