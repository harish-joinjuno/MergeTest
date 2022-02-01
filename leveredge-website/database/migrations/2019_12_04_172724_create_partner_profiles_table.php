<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnerProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('contract_type_id');
            $table->unsignedBigInteger('partner_type_id');
            $table->unsignedInteger('user_id')->unique();
            $table->timestamps();

            $table->foreign('contract_type_id')->references('id')->on('contract_types');
            $table->foreign('partner_type_id')->references('id')->on('partner_types');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partner_profiles');
    }
}
