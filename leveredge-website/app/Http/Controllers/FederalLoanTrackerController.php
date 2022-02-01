<?php

namespace App\Http\Controllers;

use App\FaqGroup;
use App\FederalLoanTracker;
use App\Http\Requests\FederalLoanTrackerEmailRequest;
use Illuminate\Http\Request;

class FederalLoanTrackerController extends Controller
{
    //
    public function index()
    {
        $faqs    = FaqGroup::find(FaqGroup::FEDERAL_STUDENT_LOAN_TRACKER)->questions;
        $updates = FederalLoanTracker::orderBy('posted_at', 'DESC')->get();
        $endDate = '2021-10-21 00:00:00';

        return view('landing-pages.federal-loans.tracker', [
            'faqs'    => $faqs,
            'updates' => $updates,
            'endDate' => $endDate,
        ]);
    }

    public function register(FederalLoanTrackerEmailRequest $request)
    {
        $request->persist();

        return redirect('/federal-loan-tracker')->with('success', true);
    }
}
