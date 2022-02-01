<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToNegotiationGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('negotiation_groups', function (Blueprint $table) {
            $table->string('display_name')
                ->nullable()
                ->after('deal_confidence');
            $table->text('dashboard_update')
                ->nullable()
                ->after('deal_confidence');
            $table->tinyInteger('display_count_based_on')
                ->default(1)
                ->after('deal_confidence');
            $table->text('progress_titles')
                ->nullable()
                ->after('deal_confidence');
            $table->text('progress_descriptions')
                ->nullable()
                ->after('deal_confidence');
            $table->tinyInteger('progress_stage')
                ->default(2)
                ->after('deal_confidence');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('negotiation_groups', function (Blueprint $table) {
            $table->dropColumn([
                'display_name',
                'dashboard_update',
                'display_count_based_on',
                'progress_titles',
                'progress_descriptions',
                'progress_stage',
            ]);
        });
    }
}
