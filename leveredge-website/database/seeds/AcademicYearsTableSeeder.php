<?php

use App\AcademicYear;
use App\Degree;
use App\NegotiationGroup;
use App\NegotiationGroupEligibleProfile;
use App\University;
use App\UserProfile;
use Illuminate\Database\Seeder;

class AcademicYearsTableSeeder extends Seeder
{
    public function run()
    {
        AcademicYear::unguard();
        NegotiationGroup::unguard();

        // Refinance
        /** @var AcademicYear $year */
        $year = AcademicYear::query()->updateOrCreate([
            'name'      => 'Refinance',
            'refinance' => true,
        ], [
            'starts_on' => '2019-06-01',
            'ends_on'   => '2020-05-31',
        ]);

        /** @var NegotiationGroup $negotiationGroup */
        $negotiationGroup = NegotiationGroup::query()->updateOrCreate([
            'name'             => 'Refinance International',
            'academic_year_id' => $year->id,
        ], [
            'slug'            => 'refinance-international',
            'priority'        => 1,
            'deal_confidence' => 0,
        ]);
        NegotiationGroupEligibleProfile::query()->updateOrCreate([
            'negotiation_group_id' => $negotiationGroup->id,
            'immigration_status'   => UserProfile::IMMIGRATION_STATUS_OTHER,
        ], []);


        $negotiationGroup = NegotiationGroup::query()->updateOrCreate([
            'name'             => 'Refinance Domestic',
            'academic_year_id' => $year->id,
        ], [
            'slug'            => 'refinance-domestic',
            'priority'        => 2,
            'deal_confidence' => 0,
        ]);
        NegotiationGroupEligibleProfile::query()->updateOrCreate([
            'negotiation_group_id' => $negotiationGroup->id,
            'immigration_status'   => UserProfile::IMMIGRATION_STATUS_US_CITIZEN_OR_PERMANENT_RESIDENT,
        ], []);

        // Spring / Winter 2020
//        $year = AcademicYear::query()->updateOrCreate([
//            'name' => 'Spring / Winter 2020',
//        ], [
//            'starts_on' => '2019-06-01',
//            'ends_on'   => '2020-05-31',
//        ]);
//
//        $negotiationGroup = NegotiationGroup::query()->updateOrCreate([
//            'name'             => 'International 19-20',
//            'academic_year_id' => $year->id,
//        ], [
//            'slug'            => 'international-19-20',
//            'priority'        => 1,
//            'deal_confidence' => 0,
//        ]);
//        NegotiationGroupEligibleProfile::query()->updateOrCreate([
//            'negotiation_group_id' => $negotiationGroup->id,
//            'immigration_status'   => UserProfile::IMMIGRATION_STATUS_OTHER,
//        ], []);
//
//        $negotiationGroup         = NegotiationGroup::query()->updateOrCreate([
//            'name'             => 'Wharton 19-20',
//            'academic_year_id' => $year->id,
//        ], [
//            'slug'            => 'wharton-19-20',
//            'priority'        => 2,
//            'deal_confidence' => 0,
//        ]);
//        $universityOfPennsylvania = University::query()
//            ->where('name', '=', 'University of Pennsylvania')
//            ->first();
//        $mba                      = Degree::query()
//            ->where('name', '=', 'MBA')
//            ->first();
//        if ($universityOfPennsylvania && $mba) {
//            NegotiationGroupEligibleProfile::query()->updateOrCreate([
//                'negotiation_group_id' => $negotiationGroup->id,
//                'grad_university_id'   => $universityOfPennsylvania->id,
//                'grad_degree_id'       => $mba->id,
//                'immigration_status'   => UserProfile::IMMIGRATION_STATUS_US_CITIZEN_OR_PERMANENT_RESIDENT,
//            ], []);
//        }
//
//        $negotiationGroup = NegotiationGroup::query()->updateOrCreate([
//            'name'             => 'Laurel Road 19-20',
//            'academic_year_id' => $year->id,
//        ], [
//            'slug'            => 'laurel-road-19-20',
//            'priority'        => 3,
//            'deal_confidence' => 0,
//        ]);
//        NegotiationGroupEligibleProfile::query()->updateOrCreate([
//            'negotiation_group_id' => $negotiationGroup->id,
//            'immigration_status'   => UserProfile::IMMIGRATION_STATUS_US_CITIZEN_OR_PERMANENT_RESIDENT,
//        ], []);
//
//        $negotiationGroup = NegotiationGroup::query()->updateOrCreate([
//            'name'             => 'Other Domestic 19-20',
//            'academic_year_id' => $year->id,
//        ], [
//            'slug'            => 'other-domestic-19-20',
//            'priority'        => 4,
//            'deal_confidence' => 0,
//        ]);
//        NegotiationGroupEligibleProfile::query()->updateOrCreate([
//            'negotiation_group_id' => $negotiationGroup->id,
//            'immigration_status'   => UserProfile::IMMIGRATION_STATUS_US_CITIZEN_OR_PERMANENT_RESIDENT,
//        ], []);

        // Academic year 2020-21
        $year             = AcademicYear::query()->updateOrCreate([
            'name' => 'Academic Year 2020-21',
        ], [
            'starts_on' => '2020-06-01',
            'ends_on'   => '2021-05-31',
        ]);
        $negotiationGroup = NegotiationGroup::query()->updateOrCreate([
            'name'             => 'General Group 20-21',
            'academic_year_id' => $year->id,
        ], [
            'slug'            => 'general-group-20-21',
            'priority'        => 1,
            'deal_confidence' => 0,
        ]);
        NegotiationGroupEligibleProfile::query()->updateOrCreate([
            'negotiation_group_id' => $negotiationGroup->id,
        ], []);


        // Academic year International Health Insurance
        $year = AcademicYear::query()->updateOrCreate([
            'name' => AcademicYear::ACADEMIC_YEAR_HEALTH_INSURANCE,
        ],[
            'starts_on' => '2019-06-01',
            'ends_on'   => '2020-05-31',
        ]);

        $negotiationGroup = NegotiationGroup::query()->updateOrCreate([
            'name'             => 'Eligible for GBG',
            'academic_year_id' => $year->id,
        ], [
            'slug'            => 'eligible-for-gbg',
            'priority'        => 1,
            'deal_confidence' => 0,
        ]);

        $rows   = $fields   = [];
        $i      = 0;
        $handle = @fopen(database_path("/seeds/international_student_health_insurance_universities.csv"), "r");
        if ($handle) {
            while (($row = fgetcsv($handle, 4096)) !== false) {
                if (empty($fields)) {
                    $fields = $row;

                    continue;
                }
                foreach ($row as $k=>$value) {
                    $rows[$i][$fields[$k]] = $value;
                }
                $i++;
            }
            if (!feof($handle)) {
                echo "Error: unexpected fgets() fail\n";
            }
            fclose($handle);
        }
        $availableUniversities = collect($rows)->filter(function ($university) {
            return $university['Insurance Available'] === 'Yes';
        })->map(function ($university) {
            return ['id' => (int)$university['id']];
        });

        if ($availableUniversities->count()) {
            foreach ($availableUniversities as $university) {
                NegotiationGroupEligibleProfile::query()->updateOrCreate([
                    'negotiation_group_id' => $negotiationGroup->id,
                    'grad_university_id'   => $university['id'],
                    'immigration_status'   => UserProfile::IMMIGRATION_STATUS_US_CONDITIONAL_PERMANENT_RESIDENT,
                ], []);
                NegotiationGroupEligibleProfile::query()->updateOrCreate([
                    'negotiation_group_id' => $negotiationGroup->id,
                    'university_id'        => $university['id'],
                    'immigration_status'   => UserProfile::IMMIGRATION_STATUS_US_CONDITIONAL_PERMANENT_RESIDENT,
                ], []);
                NegotiationGroupEligibleProfile::query()->updateOrCreate([
                    'negotiation_group_id' => $negotiationGroup->id,
                    'grad_university_id'   => $university['id'],
                    'immigration_status'   => UserProfile::IMMIGRATION_STATUS_DACA_RECIPIENT,
                ], []);
                NegotiationGroupEligibleProfile::query()->updateOrCreate([
                    'negotiation_group_id' => $negotiationGroup->id,
                    'university_id'        => $university['id'],
                    'immigration_status'   => UserProfile::IMMIGRATION_STATUS_DACA_RECIPIENT,
                ], []);
                NegotiationGroupEligibleProfile::query()->updateOrCreate([
                    'negotiation_group_id' => $negotiationGroup->id,
                    'grad_university_id'   => $university['id'],
                    'immigration_status'   => UserProfile::IMMIGRATION_STATUS_OTHER,
                ], []);
                NegotiationGroupEligibleProfile::query()->updateOrCreate([
                    'negotiation_group_id' => $negotiationGroup->id,
                    'university_id'        => $university['id'],
                    'immigration_status'   => UserProfile::IMMIGRATION_STATUS_OTHER,
                ], []);
            }
        }

        $negotiationGroup = NegotiationGroup::query()->updateOrCreate([
            'name'             => 'Not Eligible for GBG',
            'academic_year_id' => $year->id,
        ], [
            'slug'            => 'not-eligible-for-gbg',
            'priority'        => 1,
            'deal_confidence' => 0,
        ]);

        NegotiationGroupEligibleProfile::query()->updateOrCreate([
            'negotiation_group_id' => $negotiationGroup->id,
        ], []);
    }
}
