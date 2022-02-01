<?php

namespace App\Http\Controllers;

use App\FaqGroup;
use Illuminate\Http\Request;

class InsuranceController extends Controller
{
    //

    public function internationalHealth()
    {
        $faqs = FaqGroup::find(FaqGroup::INTERNATIONAL_HEALTH_INSURANCE)->questions;

        return view('landing-pages/international-health-insurance', [
            "faqs" => $faqs,
        ]);
    }

    public function internationalHealthTerms()
    {
        return view('insurance/international-health-terms');
    }
}
