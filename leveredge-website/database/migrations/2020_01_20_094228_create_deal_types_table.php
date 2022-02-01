<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateDealTypesTable extends Migration
{
    public function up()
    {
        Schema::create('deal_types', function (Blueprint $table) {
            $table->unsignedInteger('id')->primary();
            $table->string('name');
            $table->timestamps();
        });

        DB::table('deal_types')->insert([
            ['id' => 1, 'name' => 'Graduate Student Loan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Undergraduate Student Loan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Grad and Undergrad Student Loan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name' => 'Refinance Student Loan', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('deal_types');
    }
}
