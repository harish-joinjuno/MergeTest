<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScholarshipEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scholarship_emails', function (Blueprint $table) {
            $table->id();
            $table->string('internal_name');
            $table->foreignId('scholarship_id')->constrained('scholarships');
            $table->foreignId('marketing_email_template_id')->constrained('marketing_email_templates');
            $table->string('trigger_type');
            $table->unsignedInteger('days_after_entrant_joined')->nullable();
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
        Schema::dropIfExists('scholarship_emails');
    }
}
