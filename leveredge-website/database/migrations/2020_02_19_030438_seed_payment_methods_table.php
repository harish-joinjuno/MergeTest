<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;

class SeedPaymentMethodsTable extends Migration
{

    public function up()
    {
        Artisan::call('db:seed --class=PaymentMethodTableSeeder');
    }

    public function down()
    {
        //
    }
}
