<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChangesForPersistOnExistingAutoRefiApplicationsClassName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\Question::where('persist_response', 'LIKE', '%PersistOnExistingAutoRefinanceApplication%')
            ->each(function (\App\Question  $question) {
                $question->persist_response = \App\PersistResponse\PersistOnAutoRefinanceApplication::class;
                $question->save();
            });
    }

    /**p
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
