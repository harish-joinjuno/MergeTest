<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakePercentageColumnIntoDecimal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deals', function (Blueprint $table) {
            $table->dropColumn('percentage_of_loan_amount');
        });

        Schema::table('deals', function (Blueprint $table) {
            $table->decimal('percentage_of_loan_amount',6,3)->nullable()->after('fee_amount');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deals', function (Blueprint $table) {
            $table->dropColumn('percentage_of_loan_amount');
        });

        Schema::table('deals', function (Blueprint $table) {
            $table->string('percentage_of_loan_amount')->nullable()->after('fee_amount');
        });
    }
}
