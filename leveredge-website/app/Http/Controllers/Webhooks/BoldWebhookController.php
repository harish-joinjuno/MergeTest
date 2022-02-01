<?php


namespace App\Http\Controllers\Webhooks;


use App\BoldStudent;
use App\Events\NewBoldStudent;
use App\Facades\Mailchimp;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BoldWebhookController extends Controller
{
    public function store(Request $request)
    {
        $boldStudent = new BoldStudent();

        $boldStudent->full_name                          = $request->get('fullName');
        $boldStudent->street_address                     = $request->get('streetAddress');
        $boldStudent->email                              = $request->get('email');
        $boldStudent->phone_number                       = $request->get('phoneNumber');
        $boldStudent->citizenship                        = $request->get('citizenship');
        $boldStudent->credit_score                       = $request->get('creditScore');
        $boldStudent->education_degree_type              = $request->get('education')['degreeType'];
        $boldStudent->education_school_name              = $request->get('education')['schoolName'];
        $boldStudent->education_expected_graduation_year = $request->get('education')['expectedGraduationYear'];

        $boldStudent->save();

        event(new NewBoldStudent($boldStudent));

        return response()->json();
    }
}
