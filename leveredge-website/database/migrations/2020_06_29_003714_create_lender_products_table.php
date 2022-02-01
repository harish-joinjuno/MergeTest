<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLenderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lender_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('lender_id');
            $table->unsignedInteger('product_id');
            $table->timestamps();
        });

        $lenders = \Illuminate\Support\Facades\DB::table('lenders')->get();
        $inserts = [];
        foreach($lenders as $lender){
            $inserts[] = ['lender_id' => $lender->id, 'product_id' => 1];
        }
        \Illuminate\Support\Facades\DB::table('lender_products')->insert($inserts);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lender_products');
    }
}
