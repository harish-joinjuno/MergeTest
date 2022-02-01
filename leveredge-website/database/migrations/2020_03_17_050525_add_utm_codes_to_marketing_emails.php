<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUtmCodesToMarketingEmails extends Migration
{

    public function up()
    {
        Schema::table('marketing_emails', function (Blueprint $table) {
            $table->string('utm_source')->nullable();
            $table->string('utm_campaign')->nullable();
            $table->string('utm_medium')->nullable();
            $table->string('utm_term')->nullable();
            $table->string('utm_content')->nullable();
        });
    }

    public function down()
    {
        Schema::table('marketing_emails', function (Blueprint $table) {
            $table->dropColumn('utm_source');
            $table->dropColumn('utm_campaign');
            $table->dropColumn('utm_medium');
            $table->dropColumn('utm_term');
            $table->dropColumn('utm_content');
        });
    }
}
