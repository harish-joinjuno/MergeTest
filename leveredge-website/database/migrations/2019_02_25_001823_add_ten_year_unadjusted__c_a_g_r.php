<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTenYearUnadjustedCAGR extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('university_financial_datas', function (Blueprint $table) {
            $table->decimal('10_year_unadjusted_CAGR', 10, 5);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('university_financial_datas', function (Blueprint $table) {
            $table->dropColumn('10_year_unadjusted_CAGR');
        });
    }
}
