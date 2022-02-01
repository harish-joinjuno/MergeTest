<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableauDashboardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tableau_dashboards', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('url');
            $table->timestamps();
        });

        $dashboards = [
            ['label' => 'Auto Refinance Experiments', 'url' => 'https://prod-useast-a.online.tableau.com/#/site/leveredgeassociation/workbooks/257684/views'],
            ['label' => 'Student Loan Experiments', 'url' => 'https://prod-useast-a.online.tableau.com/#/site/leveredgeassociation/workbooks/257379/views'],
            ['label' => 'Cash', 'url' => 'https://prod-useast-a.online.tableau.com/#/site/leveredgeassociation/workbooks/258484/views'],
            ['label' => 'Deal Summary', 'url' => 'https://prod-useast-a.online.tableau.com/#/site/leveredgeassociation/workbooks/260305/views'],

        ];

        \Illuminate\Support\Facades\DB::table('tableau_dashboards')->insert($dashboards);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tableau_dashboards');
    }
}
