<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeeTypesTable extends Migration
{
    public function up()
    {
        Schema::create('fee_types', function (Blueprint $table) {
            $table->unsignedInteger('id')->primary();
            $table->string('name');
            $table->timestamps();
        });

        DB::table('fee_types')->insert([
            ['id' => 1, 'name' => 'Fixed Amount Per Loan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Percentage of Loans Originated', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('fee_types');
    }
}
