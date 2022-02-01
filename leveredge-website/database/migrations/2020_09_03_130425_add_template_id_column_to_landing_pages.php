<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTemplateIdColumnToLandingPages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('landing_pages', function (Blueprint $table) {
            $table->text('properties')->after('partner_profile_id')->nullable();
            $table->unsignedBigInteger('template_id')->after('partner_profile_id')->nullable();

            $table->foreign('template_id')->references('id')->on('landing_page_templates')
                ->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('landing_pages', function (Blueprint $table) {
            $table->dropForeign('landing_pages_template_id_foreign');
            $table->dropColumn([
                'template_id',
                'properties',
            ]);
        });
    }
}
