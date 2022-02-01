<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSimpleActionNotificationRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('simple_action_notification_rules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('action_notification_id');
            $table->unsignedBigInteger('negotiation_group_id')->nullable();
            $table->unsignedBigInteger('academic_year_id')->nullable();
            $table->unsignedInteger('university_id')->nullable();
            $table->unsignedInteger('degree_id')->nullable();
            $table->unsignedInteger('grad_university_id')->nullable();
            $table->unsignedInteger('grad_degree_id')->nullable();
            $table->string('immigration_status')->nullable();
            $table->string('credit_score_range')->nullable();

            $table->foreign('action_notification_id')->references('id')->on('action_notifications')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('negotiation_group_id')->references('id')->on('negotiation_groups')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('academic_year_id')->references('id')->on('academic_years')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('university_id')->references('id')->on('universities')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('degree_id')->references('id')->on('degrees')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('grad_university_id')->references('id')->on('universities')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('grad_degree_id')->references('id')->on('degrees')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('simple_action_notification_rules');
    }
}
