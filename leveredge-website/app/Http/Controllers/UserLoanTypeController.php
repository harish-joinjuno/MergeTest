<?php


namespace App\Http\Controllers;

use App\ClientRequest;
use App\NegotiationGroupUser;
use App\QuestionFlow;
use App\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserLoanTypeController extends Controller
{
    public function index()
    {
        return view('user-profile.index');
    }

    public function storeLoanType(Request $request)
    {
        $userProfile                  = userProfile();
        $userProfile->loan_type       = $request->loan_type;

        $userProfile->save();
        $routeMaps = [
            'student-loans'                          => QuestionFlow::getInitUrlForFlow(QuestionFlow::STUDENT_LOAN_QUESTION_FLOW_ID),
            'refinance'                              => QuestionFlow::getInitUrlForFlow(QuestionFlow::STUDENT_LOAN_REFINANCING_FLOW_ID),
            'international-student-health-insurance' => QuestionFlow::getInitUrlForFlow(QuestionFlow::INTERNATIONAL_STUDENT_HEALTH_INSURANCE_FLOW_ID),
            'auto-loan-refinancing'                  => QuestionFlow::getInitUrlForFlow(QuestionFlow::AUTO_LOANS_PARTNER_FLOW_ID),
        ];

        if (isset($routeMaps[$request->loan_type])) {
            return redirect()->to($routeMaps[$request->loan_type]);
        }

        return redirect()->to('dashboard');
    }
}
