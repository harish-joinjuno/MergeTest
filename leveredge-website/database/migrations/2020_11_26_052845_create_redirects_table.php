<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRedirectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('redirects', function (Blueprint $table) {
            $table->id();
            $table->string('from');
            $table->string('to');
            $table->string('method');
            $table->integer('code')->default(302);
            $table->boolean('with_query_parameters')->default(1);
            $table->timestamps();
        });

        $inserts = [
            [
                'from'   => 'from',
                'to'     => '/',
                'method' => 'method',
            ],
        ];
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('redirects');
    }
}
