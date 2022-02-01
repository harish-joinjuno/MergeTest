<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUniversityFinancialDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('university_financial_datas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('university_name');
            $table->string('slug');
            $table->integer('nominal_tuition_in_2006_07');
            $table->integer('nominal_tuition_in_2007_08');
            $table->integer('nominal_tuition_in_2008_09');
            $table->integer('nominal_tuition_in_2009_10');
            $table->integer('nominal_tuition_in_2010_11');
            $table->integer('nominal_tuition_in_2011_12');
            $table->integer('nominal_tuition_in_2012_13');
            $table->integer('nominal_tuition_in_2013_14');
            $table->integer('nominal_tuition_in_2014_15');
            $table->integer('nominal_tuition_in_2015_16');
            $table->integer('nominal_tuition_in_2016_17');
            $table->integer('nominal_tuition_in_2017_18');
            $table->decimal('tuition_in_2006_07_in_2019_dollars', 10, 5);
            $table->decimal('tuition_in_2007_08_in_2019_dollars', 10, 5);
            $table->decimal('tuition_in_2008_09_in_2019_dollars', 10, 5);
            $table->decimal('tuition_in_2009_10_in_2019_dollars', 10, 5);
            $table->decimal('tuition_in_2010_11_in_2019_dollars', 10, 5);
            $table->decimal('tuition_in_2011_12_in_2019_dollars', 10, 5);
            $table->decimal('tuition_in_2012_13_in_2019_dollars', 10, 5);
            $table->decimal('tuition_in_2013_14_in_2019_dollars', 10, 5);
            $table->decimal('tuition_in_2014_15_in_2019_dollars', 10, 5);
            $table->decimal('tuition_in_2015_16_in_2019_dollars', 10, 5);
            $table->decimal('tuition_in_2016_17_in_2019_dollars', 10, 5);
            $table->decimal('tuition_in_2017_18_in_2019_dollars', 10, 5);
            $table->decimal('nominal_tuition_inflation_in_2007_08', 10, 5);
            $table->decimal('nominal_tuition_inflation_in_2008_09', 10, 5);
            $table->decimal('nominal_tuition_inflation_in_2009_10', 10, 5);
            $table->decimal('nominal_tuition_inflation_in_2010_11', 10, 5);
            $table->decimal('nominal_tuition_inflation_in_2011_12', 10, 5);
            $table->decimal('nominal_tuition_inflation_in_2012_13', 10, 5);
            $table->decimal('nominal_tuition_inflation_in_2013_14', 10, 5);
            $table->decimal('nominal_tuition_inflation_in_2014_15', 10, 5);
            $table->decimal('nominal_tuition_inflation_in_2015_16', 10, 5);
            $table->decimal('nominal_tuition_inflation_in_2016_17', 10, 5);
            $table->decimal('nominal_tuition_inflation_in_2017_18', 10, 5);
            $table->decimal('10_year_CAGR', 10, 5);
            $table->decimal('3_year_CAGR', 10, 5);
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
        Schema::dropIfExists('university_financial_datas');
    }
}
