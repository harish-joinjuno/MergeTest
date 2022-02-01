<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSortOrderToDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deals', function (Blueprint $table) {
            $table->integer('deal_sort_order');
        });

        \App\Deal::all()
            ->each(function ($deal, $index) {
                \App\DealStatusApplicability::create([
                    'deal_id'        => $deal->id,
                    'deal_status_id' => 8, // Signed the Loan
                    'sort_order'     => $index + 1,
                ]);

                \App\DealStatusApplicability::create([
                    'deal_id'        => $deal->id,
                    'deal_status_id' => 1, // Clicked to Provider
                    'sort_order'     => $index + 1,
                ]);
            });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deals', function (Blueprint $table) {
            $table->dropColumn('deal_sort_order');
        });
    }
}
