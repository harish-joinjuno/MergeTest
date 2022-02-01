<?php

namespace App\Http\Controllers;

use App\LandingPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class PartnershipController extends Controller
{

    public function aboveTheLaw(Request $request){
        return $this->defaultPartnershipPage(
            $request,
            'above-the-law',
            "Welcome Above The Law Readers!"
        );
    }

    // TODO: Need to fix affiliate cookie setting problem.
    // TODO: Want to set the cookie with the tracking pixel.
    public function nagps(Request $request)
    {
        if($request->grow == "nagps")
        {
            return view('partnerships.nagps');
        }
        return redirect('/nagps?grow=nagps');
    }

    public function spivey(Request $request){
        if($request->grow == "peqbghrf")
        {
            return view('partnerships.spivey');
        }
        return redirect('/spivey-consulting?grow=peqbghrf');
    }

    /*
     * This is the default partnership page
     */
    public function defaultPartnershipPage(Request $request, $partners_affiliate_code, $partner_welcome_message = null){
        return view('welcome')->with([
            'partners_affiliate_code' => $partners_affiliate_code,
            'partner_welcome_message' => $partner_welcome_message
        ]);
    }

    public function partner(Request $request, $slug)
    {
        $landing_page = LandingPage::where('slug', '=', $slug)->firstOrFail();
        return view('partnerships.partner', compact('landing_page'));
    }

}
