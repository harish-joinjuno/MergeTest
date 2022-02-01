<?php

namespace App\Http\Controllers;

use App\CareerOneStopScholarship;
use App\LawScholarship;
use App\MbaScholarship;
use Illuminate\Http\Request;

class SearchScholarshipController extends Controller
{
    const TITLES = [
        'yale'          => 'Yale SOM',
        'mit-sloan'	    => 'Sloan',
        'hbs'           => 'HBS',
        'stanford-gsb'	 => 'GSB',
        'haas'          => 'Haas',
        'ross'          => 'Ross',
        'foster'        => 'UW',
        'cornell'       => 'Cornell',
        'uw-madison'    => 'UW Madison',
        'columbia-gsb'  => 'GSB',
        'anderson'      => 'Anderson',
        'mccombs'       => 'McCombs',
        'geis'          => 'Geis',
        'nyu-stern'     => 'NYU Stern',
        'wharton'       => 'Wharton',
        'marshall'      => 'Marshall',
        'tepper'        => 'Tepper',
        'asu'           => 'ASU',
        'booth'         => 'Booth',
        'fuqua'         => 'Fuqua',
    ];

    public function index()
    {
        return view('scholarships-index');
    }

    public function searchMbaScholarships()
    {
        return view('browse_scholarships', [
            'scholarships' => MbaScholarship::orderByRaw('ISNULL(application_due_by), application_due_by ASC')
                ->whereNull('application_due_by')
                ->orWhereDate('application_due_by', '>=' , today())
                ->get(),
        ]);
    }

    public function searchMbaScholarshipsForSchool($school)
    {
        if ( !array_key_exists($school, self::TITLES) ) {
            abort(404);
        }

        $title = self::TITLES[$school];

        return view('browse_scholarships', [
            'scholarships' => MbaScholarship::orderByRaw('ISNULL(application_due_by), application_due_by ASC')
                ->whereNull('application_due_by')
                ->orWhereDate('application_due_by', '>=' , today())
                ->get(),

            'title' => $title,
        ]);
    }

    public function searchLawScholarships()
    {
        return view('browse_law_scholarships', [
            'scholarships' => LawScholarship::orderByRaw('ISNULL(application_due_by), application_due_by ASC')
                ->whereNull('application_due_by')
                ->orWhereDate('application_due_by', '>=' , today())
                ->get(),
        ]);
    }

    public function searchLawScholarshipsForSchool($school)
    {
        if ( !array_key_exists($school, self::TITLES) ) {
            abort(404);
        }

        $title = self::TITLES[$school];

        return view('browse_law_scholarships', [
            'scholarships' => LawScholarship::orderByRaw('ISNULL(application_due_by), application_due_by ASC')
                ->whereNull('application_due_by')
                ->orWhereDate('application_due_by', '>=' , today())
                ->get(),

            'title' => $title,
        ]);
    }

    public function generalScholarships()
    {
        $scholarships = CareerOneStopScholarship::all();
        return view('browse_general_scholarships', [
            'scholarships' => $scholarships,
            'totalResults' => $scholarships->count(),
        ]);
    }
}
