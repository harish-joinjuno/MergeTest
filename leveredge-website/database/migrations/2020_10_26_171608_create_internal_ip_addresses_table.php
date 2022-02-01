<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternalIpAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internal_ip_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('ip')->nullable();
            $table->timestamps();
        });

        $mappings = [
            'Nick'    => '24.60.255.154',
            'Ali'     => '102.189.252.167',
            'Max'     => '173.69.36.65',
            'Suraiya' => '70.119.86.119',
            'Shub'    => '10.105.180.191',
            'Otto'    => '73.219.65.157',
            'Helene'  => '10.148.44.137',
            'Linda'   => '173.48.229.194',
            'Nicolas' => '192.168.1.107',
            'Hrach'   => '37.186.72.116',
        ];

        foreach ($mappings as $name => $ip) {
            \App\InternalIpAddress::create([
                'name' => $name,
                'ip'   => $ip,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('internal_ip_addresses');
    }
}
