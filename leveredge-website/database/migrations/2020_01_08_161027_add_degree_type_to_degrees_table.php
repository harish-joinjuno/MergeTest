<?php

use App\Degree;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddDegreeTypeToDegreesTable extends Migration
{
    public function up()
    {
        Schema::table('degrees', function (Blueprint $table) {
            $table->string('degree_type')->nullable()->after('name');
        });

        $degrees = [
            Degree::TYPE_UNDERGRADUATE => [
                'Accounting',
                'Agriculture',
                'Allied Health/Medical Admin',
                'Architecture',
                'Biology',
                'Broadcasting, Recording',
                'Business Administration',
                'Business',
                'Chemistry',
                'Communications',
                'Computer Science',
                'Continuing Education',
                'Cosmetology',
                'Criminal Justice',
                'Culinary Arts',
                'Dental Assist/Dental Lab/Med Assist/Pharmacy Tech',
                'Economics',
                'Education',
                'Engineering',
                'English',
                'Film',
                'Fine Arts',
                'Fitness/Exercise',
                'Graphic Design',
                'History',
                'Hospitality',
                'Information Technology',
                'International Rels.',
                'Law and Law Studies',
                'Liberal Arts',
                'Marketing',
                'Mathematics',
                'Mechanics',
                'Medical Billing',
                'Medical',
                'Music',
                'Nursing',
                'Paralegal',
                'Philosophy',
                'Physics',
                'Political Science',
                'Psychology',
                'Sales',
                'Web/Online Student',
                'Other',
            ],
        ];

        $mapName = [
            'Dental' => 'Dental Assist/Dental Lab/Med Assist/Pharmacy Tech',
        ];

        foreach ($mapName as $from => $to) {
            DB::table('degrees')
                ->where('name', '=', $from)
                ->update(['name' => $to]);
        }

        foreach ($degrees as $degreeType => $names) {
            array_walk($names, function ($name) use ($degreeType) {
                DB::table('degrees')->updateOrInsert([
                    'name' => $name,
                ], [
                    'degree_type' => $degreeType,
                ]);
            });
        }

        $mapIds = [
            'Undergraduate' => null,
        ];

        foreach ($mapIds as $from => $to) {
            $fromDegree = DB::table('degrees')
                ->where('name', '=', $from)
                ->first();
            if (!$fromDegree) continue;

            if ($to === null) {
                DB::table('user_profiles')
                    ->where('degree_id', '=', $fromDegree->id)
                    ->update(['degree_id' => null]);

                DB::table('user_profiles')
                    ->where('grad_degree_id', '=', $fromDegree->id)
                    ->update(['grad_degree_id' => null]);

                continue;
            }

            $toDegree = DB::table('degrees')
                ->where('name', '=', $to)
                ->first();
            if (!$toDegree) continue;

            DB::table('user_profiles')
                ->where('degree_id', '=', $fromDegree->id)
                ->update(['degree_id' => $toDegree->id]);

            DB::table('user_profiles')
                ->where('grad_degree_id', '=', $fromDegree->id)
                ->update(['grad_degree_id' => $toDegree->id]);
        }
    }

    public function down()
    {
        Schema::table('degrees', function (Blueprint $table) {
            $table->dropColumn('degree_type');
        });
    }
}
