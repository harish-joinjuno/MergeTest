<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_terms', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->integer('years');
            $table->timestamps();
        });

        \Illuminate\Support\Facades\DB::table('loan_terms')->insert([
            ['name' => '5 Years', 'years' => 5],
            ['name' => '7 Years', 'years' => 7],
            ['name' => '8 Years', 'years' => 8],
            ['name' => '10 Years', 'years' => 10],
            ['name' => '15 Years', 'years' => 15],
            ['name' => '20 Years', 'years' => 20]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loan_terms');
    }
}
