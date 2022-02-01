<?php

namespace App\Http\Controllers;

use App\Degree;
use App\Events\ScholarshipEntrantCreated;
use App\FaqGroup;
use App\Scholarship;
use App\ScholarshipEntrant;
use App\University;
use Illuminate\Http\Request;


class ScholarshipController extends Controller
{
    public function index()
    {
        $scholarship = Scholarship::orderBy('id','desc')->first();

        return redirect('scholarship/' . $scholarship->slug );
    }

    public function show(Request $request, Scholarship $scholarship)
    {
        $variables = [
            'scholarship' => $scholarship,
        ];

        foreach ($scholarship->scholarshipContents as $scholarshipContent) {
            $variables[$scholarshipContent->name] = $scholarshipContent->body;
        }

        return view( 'scholarship.template.show.' . $scholarship->scholarshipTemplate->view, $variables);
    }

    public function terms()
    {
        return view( 'scholarship.terms');
    }

    public function holidayGiveawayTerms()
    {
        return view( 'scholarship.holiday-giveaway-terms');
    }

    public function saveEntrant(Request $request, Scholarship $scholarship)
    {
        foreach ($scholarship->scholarshipQuestions as $question) {
            $validationRules[$question->field_name] = $question->validation_rules;
        }

        $validatedData = $request->validate($validationRules);

        /** @var ScholarshipEntrant $entrant */
        $entrant                 = ScholarshipEntrant::firstOrNew([
            'email'          => $validatedData['email'],
            'scholarship_id' => $scholarship->id,
            ]);

        $entrant->first_name     = $validatedData['first_name'];
        $entrant->last_name      = $validatedData['last_name'];
        $entrant->email          = $validatedData['email'];
        $entrant->scholarship_id = $scholarship->id;

        $answers = [];
        foreach ($scholarship->scholarshipQuestions as $question) {
            $field_name           = $question->field_name;
            $answers[$field_name] = $validatedData[$field_name];
        }
        $entrant->answers = $answers;

        if ($request->has('university')) {
            $university = University::whereName($request['university'])->first();
            if ($university) {
                $entrant->university_id = $university->id;
            }
        }

        if ($request->has('degree')) {
            $degree = Degree::whereName($request['degree'])->first();
            if ($degree) {
                $entrant->degree_id = $degree->id;
            }
        }

        if ($request->has('graduation_year')) {
            $graduationYear = (integer)$request['graduation_year'];
            if ($graduationYear) {
                $entrant->graduation_year = $graduationYear;
            }
        }

        $entrant->save();

        event(new ScholarshipEntrantCreated($entrant));

        return redirect('scholarship/' . $scholarship->slug . '/entrant/' . $entrant->id );
    }

    public function success(Request $request, Scholarship $scholarship, ScholarshipEntrant $scholarshipEntrant)
    {
        $variables = [
            'scholarship'        => $scholarship,
            'scholarshipEntrant' => $scholarshipEntrant,
            'faqs'               => FaqGroup::find(FaqGroup::SCHOLARSHIP_PAGES)->questions,
        ];

        foreach ($scholarship->scholarshipContents as $scholarshipContent) {
            $variables[$scholarshipContent->name] = $scholarshipContent->body;
        }

        return view('scholarship.template.success.' . $scholarship->scholarshipTemplate->success_view , $variables);
    }
}
