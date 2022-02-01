<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddDegreeIdAndUniversityIdToLaurelRoadEligibleSchoolsTable extends Migration
{

    public function up()
    {
        Schema::table('laurel_road_eligible_schools', function (Blueprint $table) {
            $table->renameColumn('university', 'university_name');
            $table->unsignedInteger('university_id')->nullable()->after('id');
            $table->unsignedInteger('degree_id')->nullable()->after('university_id');
            $table->date('law_tuition_due_date')->nullable()->change();
            $table->date('business_tuition_due_date')->nullable()->change();
            $table->foreign('university_id')->references('id')->on('universities')->onDelete('set null');
            $table->foreign('degree_id')->references('id')->on('degrees')->onDelete('set null');
        });

        DB::statement("alter table laurel_road_eligible_schools modify created_at datetime null after business_tuition_due_date");
        DB::statement("alter table laurel_road_eligible_schools modify updated_at datetime null after created_at");
    }

    public function down()
    {
        Schema::table('laurel_road_eligible_schools', function (Blueprint $table) {
            $table->renameColumn('university_name', 'university');
            $table->dropForeign(['university_id']);
            $table->dropForeign(['degree_id']);
            $table->dropColumn(['university_id', 'degree_id']);
        });
    }
}
