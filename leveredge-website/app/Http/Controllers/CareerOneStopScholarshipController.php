<?php

namespace App\Http\Controllers;

use App\CareerOneStopScholarship;
use Illuminate\Http\Request;

class CareerOneStopScholarshipController extends Controller
{
    public function save(Request $request)
    {
        $request->validate([
            'scholarships.*.career_one_stop_id' => 'required|integer|min:1',
        ]);

        $fields = [
            'name',
            'organization',
            'phone_number',
            'email',
            'fax_number',
            'level_of_study',
            'award_type',
            'purpose',
            'focus',
            'qualifications',
            'criteria',
            'funds',
            'duration',
            'number_of_awards',
            'to_apply',
            'deadline',
            'contact',
            'for_more_information',
        ];

        foreach ($request->scholarships as $scholarship) {
            $entry = CareerOneStopScholarship::withTrashed()->firstOrCreate([
                'career_one_stop_id' => $scholarship['career_one_stop_id'],
            ]);

            foreach ($fields as $field) {
                if (isset($scholarship[$field])) {
                    $entry->$field = $this->trimLength($scholarship[$field], $field);
                }
            }
            $entry->save();
        }

        return response([],200);
    }

    protected function trimLength($string, $field)
    {
        $trimLength = [
            'name'                 => 65530,
            'organization'         => 65530,
            'phone_number'         => 250,
            'email'                => 250,
            'fax_number'           => 250,
            'level_of_study'       => 65530,
            'award_type'           => 65530,
            'purpose'              => 65530,
            'focus'                => 65530,
            'qualifications'       => 65530,
            'criteria'             => 65530,
            'funds'                => 250,
            'duration'             => 250,
            'number_of_awards'     => 250,
            'to_apply'             => 65530,
            'deadline'             => 250,
            'contact'              => 65530,
            'for_more_information' => 65530,
        ];
        return substr($string,0,$trimLength[$field]);
    }
}
