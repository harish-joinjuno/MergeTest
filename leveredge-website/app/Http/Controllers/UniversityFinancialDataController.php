<?php

namespace App\Http\Controllers;

use App\Http\Middleware\PasswordProtect;
use App\UniversityFinancialData;
use Illuminate\Http\Request;

class UniversityFinancialDataController extends Controller
{


    public function __construct()
    {
//        $this->middleware('password-protected');
    }

    public function showSummary(){
        $universities = UniversityFinancialData::orderBy('university_name')->get();
        return view('data.university-financial.summary')->with('universities', $universities);
    }

    public function showSchoolData( Request $request, $university_slug){
        $university = UniversityFinancialData::where('slug', '=', $university_slug)->firstOrFail();
        $universities = UniversityFinancialData::orderBy('university_name')->get();
        return view('data.university-financial.index')->with('university', $university)->with('universities', $universities);
    }

}
