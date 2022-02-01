<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyLandingPageTable extends Migration
{

    public function up()
    {
        Schema::table('landing_pages', function (Blueprint $table) {
            $table->text('message_in_blue_bar')->nullable();
            $table->text('quote')->nullable(true)->change();
            $table->string('quote_author')->nullable(true)->change();
            $table->dropColumn('top_message');
        });

        Schema::table('landing_pages', function (Blueprint $table) {
            $table->text('top_message')->nullable();
        });
    }

    public function down()
    {
        Schema::table('landing_pages', function (Blueprint $table) {
            $table->dropColumn('message_in_blue_bar');
            $table->text('quote')->nullable(false)->change();
            $table->string('quote_author')->nullable(false)->change();
            $table->dropColumn('top_message');
        });

        Schema::table('landing_pages', function (Blueprint $table) {
            $table->string('top_message');
        });
    }
}
