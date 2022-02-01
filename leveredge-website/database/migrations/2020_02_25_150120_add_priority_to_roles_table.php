<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddPriorityToRolesTable extends Migration
{

    public function up()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->integer('priority')->default(1);
        });

        DB::statement("UPDATE roles SET priority = 1 WHERE name = 'admin'");
        DB::statement("UPDATE roles SET priority = 2 WHERE name = 'partner'");
        DB::statement("UPDATE roles SET priority = 3 WHERE name = 'lender'");
        DB::statement("UPDATE roles SET priority = 4 WHERE name = 'borrower'");
    }

    public function down()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->dropColumn('priority');
        });
    }
}
