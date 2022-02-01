<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutoRefinanceApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auto_refinance_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('restrict')
                ->onDelete('restrict');
            $table->string('experiment_id')->nullable();
            //vehicle
            $table->string('vin')->nullable();
            $table->string('license_plate')->nullable();
            $table->string('license_plate_state')->nullable();
            $table->string('vehicle_model')->nullable();
            $table->string('vehicle_make')->nullable();
            $table->string('vehicle_year')->nullable();
            //payment
            $table->string('payoff_amount')->nullable();
            $table->string('monthly_payment')->nullable();
            $table->string('mileage')->nullable();
            //personal
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('email')->nullable();
            //housing
            $table->string('street_address')->nullable();
            $table->string('street_address_2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip_code')->nullable(); // Already exists on user_profile
            $table->string('residence_ownership')->nullable();
            $table->string('stay_duration')->nullable();
            $table->unsignedInteger('housing_payment')->nullable(); // Already exists on user_profile
            //employment
            $table->string('employment_status')->nullable();
            $table->string('yearly_pre_tax_income')->nullable();
            $table->string('work_duration')->nullable();
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
        Schema::dropIfExists('auto_refinance_applications');
    }
}
