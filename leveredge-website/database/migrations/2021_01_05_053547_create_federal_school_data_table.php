<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFederalSchoolDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('federal_school_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('university_id')->constrained('universities','id');
            $table->bigInteger('opeid');
            $table->string('institution_name');
            $table->integer('full_time_enrollment');
            $table->decimal('percentage_using_private');
            $table->bigInteger('total_private_borrowing');
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
        Schema::dropIfExists('federal_school_data');
    }
}
