<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class RedirectController extends Controller
{


    public function redirectAcceptedMembersToStudentLoanDeal(){
        return $this->redirectToStudentLoanDeal('accepted');
    }

    public function redirectFacebookToStudentLoanDeal(){
        return $this->redirectToStudentLoanDeal('facebook');
    }

    public function redirectClearAdmitMembersToStudentLoanDeal(){
        return $this->redirectToStudentLoanDeal('clear-admit');
    }

    public function redirectPrincetonReviewMembersToStudentLoanDeal(){
        return $this->redirectToStudentLoanDeal('princeton-review');
    }

    public function redirectMLTMembersToStudentLoanDeal(){
        return $this->redirectToStudentLoanDeal('mlt');
    }

    public function redirectPoetsAndQuantsMembersToStudentLoanDeal(){
        return $this->redirectToStudentLoanDeal('poets-and-quants');
    }

    public function redirectAboveTheLawMembersToStudentLoanDeal(){
        return $this->redirectToStudentLoanDeal('above-the-law');
    }

    public function redirectBluePrintMembersToStudentLoanDeal(){
        return $this->redirectToStudentLoanDeal('blueprint');
    }

    public function redirectKaplanMembersToStudentLoanDeal(){
        return $this->redirectToStudentLoanDeal('kaplan');
    }

    public function redirectGMATClubMembersToStudentLoanDeal(){
        return $this->redirectToStudentLoanDeal('gmat-club');
    }

    public function redirectGMACMembersToStudentLoanDeal(){
        return $this->redirectToStudentLoanDeal('gmac');
    }

    public function redirectWallStreetJournalMembersToStudentLoanDeal(){
        return $this->redirectToStudentLoanDeal('wsj');
    }

    public function redirectIvyAdvisorsToStudentLoanDeal(){
        return $this->redirectToStudentLoanDeal('ivyadvisors');
    }

    public function redirectNAGPSToStudentLoanDeal(){
        return $this->redirectToStudentLoanDeal('nagps');
    }

    public function redirectDukeLawToStudentLoanDeal(){
        return $this->redirectToStudentLoanDeal('duke');
    }

    public function redirectCornellLawToStudentLoanDeal(){
        return $this->redirectToStudentLoanDeal('cornell');
    }

    public function redirectColumbiaMedToStudentLoanDeal(){
        return $this->redirectToStudentLoanDeal('columbia');
    }

    protected function redirectToStudentLoanDeal($access_code){
        return redirect('negotiated-in-school-deal')->withCookie( Cookie::make('accessCode',$access_code,100000) );
    }





    public function redirectAcceptedMembersToRefinanceDeal(){
        return $this->redirectToRefinanceDeal('accepted');
    }

    public function redirectClearAdmitMembersToRefinanceDeal(){
        return $this->redirectToRefinanceDeal('clear-admit');
    }

    public function redirectPrincetonReviewMembersToRefinanceDeal(){
        return $this->redirectToRefinanceDeal('princeton-review');
    }

    public function redirectMLTMembersToRefinanceDeal(){
        return $this->redirectToRefinanceDeal('mlt');
    }

    public function redirectPoetsAndQuantsMembersToRefinanceDeal(){
        return $this->redirectToRefinanceDeal('poets-and-quants');
    }

    public function redirectAboveTheLawMembersToRefinanceDeal(){
        return $this->redirectToRefinanceDeal('above-the-law');
    }

    public function redirectBluePrintMembersToRefinanceDeal(){
        return $this->redirectToRefinanceDeal('blueprint');
    }

    public function redirectKaplanMembersToRefinanceDeal(){
        return $this->redirectToRefinanceDeal('kaplan');
    }

    public function redirectGMATClubMembersToRefinanceDeal(){
        return $this->redirectToRefinanceDeal('gmat-club');
    }

    public function redirectGMACMembersToRefinanceDeal(){
        return $this->redirectToRefinanceDeal('gmac');
    }

    public function redirectWallStreetJournalMembersToRefinanceDeal(){
        return $this->redirectToRefinanceDeal('wsj');
    }

    public function redirectAndersonMembersToRefinanceDeal(){
        return $this->redirectToRefinanceDeal('anderson');
    }

    public function redirectIvyAdvisorsToRefinanceDeal(){
        return $this->redirectToRefinanceDeal('ivyadvisors');
    }

    protected function redirectToRefinanceDeal($access_code){
        return redirect('negotiated-refinance-deal')->withCookie( Cookie::make('accessCode',$access_code,100000) );
    }



}
