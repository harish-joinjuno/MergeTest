<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLawScholarshipsTable extends Migration
{

    public function up()
    {
        Schema::create('law_scholarships', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->date('application_due_by')->nullable();
            $table->string('max_amount')->nullable();
            $table->text('description')->nullable();
            $table->string('link')->nullable();
            $table->string('eligible_gender')->nullable();
            $table->string('eligible_protected_classes')->nullable();
            $table->boolean('citizenship_requirement')->nullable();
            $table->string('eligible_states')->nullable();
            $table->decimal('minimum_eligible_gpa', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('law_scholarships');
    }
}
