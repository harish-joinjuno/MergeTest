<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnerClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_claims', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('partner_id');
            $table->foreign('partner_id')->references('id')->on('users');
            $table->unsignedInteger('amount');
            $table->foreignId('payment_method_id')->nullable()->constrained();
            $table->foreignId('payment_id')->unique()->nullable()->constrained();
            $table->boolean('payment_completed')->default(false);
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
        Schema::dropIfExists('partner_claims');
    }
}
