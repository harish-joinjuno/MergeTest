<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderSortToSortableTables extends Migration
{
    public function up()
    {
        Schema::table('campus_ambassador_tasks', function (Blueprint $table) {
            $table->integer('sort_order')->default(99);
        });

        Schema::table('negotiation_group_faq_categories', function (Blueprint $table) {
            $table->integer('sort_order')->default(99);
        });

        Schema::table('negotiation_group_faqs', function (Blueprint $table) {
            $table->integer('sort_order')->default(99);
        });

        Schema::table('menu_links', function (Blueprint $table) {
            $table->integer('sort_order')->default(99);
        });

        DB::statement('UPDATE campus_ambassador_tasks SET sort_order = id');
        DB::statement('UPDATE negotiation_group_faq_categories SET sort_order = id');
        DB::statement('UPDATE negotiation_group_faqs SET sort_order = id');
        DB::statement('UPDATE menu_links SET sort_order = id');
    }

    public function down()
    {
        Schema::table('campus_ambassador_tasks', function (Blueprint $table) {
            $table->dropColumn('sort_order');
        });

        Schema::table('negotiation_group_faq_categories', function (Blueprint $table) {
            $table->dropColumn('sort_order');
        });

        Schema::table('negotiation_group_faqs', function (Blueprint $table) {
            $table->dropColumn('sort_order');
        });

        Schema::table('menu_links', function (Blueprint $table) {
            $table->dropColumn('sort_order');
        });
    }
}
