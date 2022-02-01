<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InSchoolController extends Controller
{
    public function showHowToSwitchLoanProvider(Request $request)
    {
        return view('in-school.switch_loan_provider.info');
    }
}
