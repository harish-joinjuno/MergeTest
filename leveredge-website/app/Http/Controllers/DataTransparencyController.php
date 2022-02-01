<?php

namespace App\Http\Controllers;

use App\Lender;
use App\LoanTerm;
use App\RateType;
use App\RepaymentPlan;
use Illuminate\Http\Request;

class DataTransparencyController extends Controller
{
    public function index()
    {
        return view('data-transparency.index');
    }

    public function showSubmitQuote()
    {
        $loan_terms = LoanTerm::all();
        $repayment_plans = RepaymentPlan::all();
        $rate_types = RateType::all();
        $lenders = Lender::all();

        return view('data-transparency.submit-a-quote')->with(
            compact(
                'loan_terms',
                'repayment_plans',
                'rate_types',
                'lenders'
        ));
    }
}
