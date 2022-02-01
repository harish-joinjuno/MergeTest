<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public function showStudentLoanComparisonCalculator()
    {
        return view('calculator.student_loan_comparison');
    }


    public function showFederalVsNegotiatedCalculator()
    {
        return view('calculator.negotiated_deal_vs_federal_loan_calculator');
    }

    public function showCommonbondMbaCalculator()
    {
        return view('calculator.commonbond_mba_loan_calculator');
    }

    public function showFederalStudentLoanCost()
    {
        return view('calculator.federal_student_loan_cost');
    }

    public function compareMyOptions() {
        return view('calculator.compare_my_options');
    }

    public function compareMyRefinanceOptions() {
        return view('calculator.compare_my_refinance_options');
    }
}
