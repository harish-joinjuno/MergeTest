<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaurelRoadRefinanceReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laurel_road_refinance_reports', function (Blueprint $table) {
            $table->id();
            $table->integer('parnter_org_id')->nullable();
            $table->string('partner_org_name')->nullable();
            $table->date('application_date')->nullable();
            $table->decimal('app_amount',10,2,true)->nullable();
            $table->string('url_upcase')->nullable();
            $table->string('los_stage')->nullable();
            $table->boolean('cosigner_flag')->nullable();
            $table->date('closing_date')->nullable();
            $table->boolean('resident_flag')->nullable();
            $table->date('rates_publish_date')->nullable();
            $table->date('hard_pull_at')->nullable();
            $table->integer('loan_term')->nullable();
            $table->string('loan_rate_type')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->decimal('amount_waterfall',10,2,true)->nullable();
            $table->string('degree')->nullable();
            $table->string('med_specialty')->nullable();
            $table->decimal('full_amount',10,2,true)->nullable();
            $table->string('discount_partner')->nullable();
            $table->string('discount_camaign_description')->nullable();
            $table->string('school')->nullable();
            $table->foreignId('access_the_deal_id')->nullable();
            $table->timestamps();

            $table->unique([
                'application_date',
                'app_amount',
                'zip',
            ],'unique_report_fields');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laurel_road_refinance_reports');
    }
}
