<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDashboardButtonCtaAndHideDashboardButtonColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('negotiation_groups', function (Blueprint $table) {
            $table->string('dashboard_button_cta')->nullable();
            $table->boolean('hide_dashboard_button')->default(false);
        });

        Schema::table('academic_years', function (Blueprint $table) {
            $table->string('dashboard_button_cta')->nullable();
            $table->boolean('hide_dashboard_button')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('negotiation_groups', function (Blueprint $table) {
            $table->dropColumn([
                'dashboard_button_cta',
                'hide_dashboard_button',
            ]);
        });

        Schema::table('academic_years', function (Blueprint $table) {
            $table->dropColumn([
                'dashboard_button_cta',
                'hide_dashboard_button',
            ]);
        });
    }
}
