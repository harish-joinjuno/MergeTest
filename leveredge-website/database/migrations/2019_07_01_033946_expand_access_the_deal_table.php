<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExpandAccessTheDealTable extends Migration
{

    public function up()
    {
        Schema::table('access_the_deals', function (Blueprint $table) {
            $table->string('cosigner_status')->nullable();
            $table->integer('graduation_year')->nullable();
        });
    }

    public function down()
    {
        Schema::table('access_the_deals', function (Blueprint $table) {
            if (Schema::hasColumn('access_the_deals', 'cosigner_status'))
                $table->dropColumn('cosigner_status');
            if (Schema::hasColumn('access_the_deals', 'graduation_year'))
                $table->dropColumn('graduation_year');
        });
    }
}
