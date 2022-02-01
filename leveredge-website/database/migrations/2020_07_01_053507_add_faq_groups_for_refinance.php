<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFaqGroupsForRefinance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::table('faq_groups')->insert([
            ['name' => 'Recommended Medical in FR Cities (Refinance)'],
            ['name' => 'Recommended Medical outside FR Cities (Refinance)'],
            ['name' => 'Recommended Non Medical in FR Cities (Refinance)'],
            ['name' => 'Recommended Non Medical outside FR Cities (Refinance)'],
            ['name' => 'Laurel Road Deal Detail Page (Refinance)'],
            ['name' => 'Earnest Deal Detail Page (Refinance)'],
            ['name' => 'First Republic Deal Detail Page (Refinance)'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Don't do anything
    }
}
