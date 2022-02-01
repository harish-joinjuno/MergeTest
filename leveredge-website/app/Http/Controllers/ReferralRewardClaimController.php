<?php

namespace App\Http\Controllers;

use App\ReferralRewardClaim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReferralRewardClaimController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Make sure the form was properly filled out
        $this->claimValidator($request->all())->validate();

        // Process Cash For Being Referred Claim
        if($request->has('cash_for_being_referred_option')){
            $this->fileCashForBeingReferredClaim($request);
        }

        // Process Cash For Referrals
        if($request->has('cash_for_referrals')){
            $this->fileCashForReferralsClaim($request);
        }

        // Process T Shirt Claim
        if($request->has('shirt_size')){
            $this->fileShirtClaim($request);
        }

        // Process Back Pack Claim
        if($request->has('back_pack_option')){
            $this->fileBackPackClaim($request);
        }

        // Process Headphone Claim
        if($request->has('headphone_option')){
            $this->fileHeadphoneClaim($request);
        }

        // Process Smart Watch Claim
        if($request->has('smart_watch_option')){
            $this->fileAppleWatchClaim($request);
        }

        // Process $3K Cash Claim
        if($request->has('three_thousand_cash_option')){
            $this->fileThreeThousandCashClaim($request);
        }

        // Process $10K Cash Claim
        if($request->has('ten_thousand_cash_option')){
            $this->fileTenThousandCashClaim($request);
        }

        // Process 1 Year Tuition Claim
        if($request->has('one_year_tuition_option')){
            $this->fileOneYearTuitionClaim($request);
        }


        return redirect('/referral-program');
    }

    /*
     * Add Common Fields from the Claim
     */
    protected function updateClaimWithCommonRequestData(Request $request, ReferralRewardClaim $claim){
        $claim->address_line_one = $request->address_line_one;
        $claim->address_line_two = $request->address_line_two;
        $claim->address_line_three = $request->address_line_three;
        $claim->city = $request->city;
        $claim->state = $request->state;
        $claim->zip_code = $request->zip_code;
        $claim->save();
    }

    /*
     * File a claim for being referred
     */
    protected function fileCashForBeingReferredClaim(Request $request){
        if($request->user()->is_eligible_for_cash_for_being_referred){
            if($request->cash_for_being_referred_option != "none"){
                $claim = new ReferralRewardClaim();
                $claim->reward = 'For Being Referred: $25 ' . $request->cash_for_being_referred_option;
                $claim->value = 25;
                $claim->user_id = $request->user()->id;
                $claim->save();
                $this->updateClaimWithCommonRequestData($request, $claim);
            }
        }
    }

    /*
     * File a Claim for Referrals
     */
    protected function fileCashForReferralsClaim(Request $request){
        if($request->user()->is_eligible_for_cash_for_referrals){
            if($request->cash_for_referrals != "none"){
                $claim = new ReferralRewardClaim();
                $claim->reward = 'For Referrals: ' . $request->cash_for_referrals . ' ($' . $request->user()->unclaimed_cash_for_referrals . ')';
                $claim->value = $request->user()->unclaimed_cash_for_referrals;
                $claim->user_id = $request->user()->id;
                $claim->save();
                $this->updateClaimWithCommonRequestData($request, $claim);
            }
        }
    }

    /*
     * File a claim for the t-shirt
     */
    protected function fileShirtClaim(Request $request){
        if($request->user()->is_eligible_for_shirt){
            if($request->shirt_size != "none"){
                $claim = new ReferralRewardClaim();
                $claim->reward = 'Shirt: ' . $request->shirt_size;
                $claim->value = 10;
                $claim->user_id = $request->user()->id;
                $claim->save();
                $this->updateClaimWithCommonRequestData($request, $claim);
            }
        }
    }

    /*
     * File a claim for the backpack
     */
    protected function fileBackPackClaim(Request $request){
        if($request->user()->is_eligible_for_back_pack){
            if($request->back_pack_option != "none"){
                $claim = new ReferralRewardClaim();
                $claim->reward = 'Backpack: ' . $request->back_pack_option;
                $claim->value = 99;
                $claim->user_id = $request->user()->id;
                $claim->save();
                $this->updateClaimWithCommonRequestData($request, $claim);
            }
        }
    }

    /*
     * File a claim for the Headphones
     */
    protected function fileHeadphoneClaim(Request $request){
        if($request->user()->is_eligible_for_air_pods){
            if($request->headphone_option != "none"){
                $claim = new ReferralRewardClaim();
                $claim->reward = 'Headphone: ' . $request->headphone_option;
                $claim->value = 200;
                $claim->user_id = $request->user()->id;
                $claim->save();
                $this->updateClaimWithCommonRequestData($request, $claim);
            }
        }
    }

    /*
     * File a claim for the Smart Watch / Apple Watch
     */
    protected function fileAppleWatchClaim(Request $request){
        if($request->user()->is_eligible_for_apple_watch){
            if($request->smart_watch_option != "none"){
                $claim = new ReferralRewardClaim();
                $claim->reward = 'Smart Watch: ' . $request->smart_watch_option;
                $claim->value = 400;
                $claim->user_id = $request->user()->id;
                $claim->save();
                $this->updateClaimWithCommonRequestData($request, $claim);
            }
        }
    }

    /*
     * File a Claim for the $3K Cash Reward
     */
    protected function fileThreeThousandCashClaim(Request $request){
        if($request->user()->is_eligible_for_three_thousand_cash_reward){
            if($request->three_thousand_cash_option != "none"){
                $claim = new ReferralRewardClaim();
                $claim->reward = '$3K: ' . $request->three_thousand_cash_option;
                $claim->value = 3000;
                $claim->user_id = $request->user()->id;
                $claim->save();
                $this->updateClaimWithCommonRequestData($request, $claim);
            }
        }
    }

    /*
     * File a Claim for the $10K Cash Reward
     */
    protected function fileTenThousandCashClaim(Request $request){
        if($request->user()->is_eligible_for_ten_thousand_cash_reward){
            if($request->ten_thousand_cash_option != "none"){
                $claim = new ReferralRewardClaim();
                $claim->reward = '$10K: ' . $request->ten_thousand_cash_option;
                $claim->value = 10000;
                $claim->user_id = $request->user()->id;
                $claim->save();
                $this->updateClaimWithCommonRequestData($request, $claim);
            }
        }
    }

    /*
     * File a Claim for the 1 Year Tuition Reward
     */
    protected function fileOneYearTuitionClaim(Request $request){
        if($request->user()->is_eligible_for_one_year_tuition_reward){
            if($request->one_year_tuition_option != "none"){
                $claim = new ReferralRewardClaim();
                $claim->reward = '1 Year Tuition: ' . $request->one_year_tuition_option;
                $claim->value = 80000;
                $claim->user_id = $request->user()->id;
                $claim->save();
                $this->updateClaimWithCommonRequestData($request, $claim);
            }
        }
    }

    /*
     * Basic check to make sure the claim is valid
     */
    protected function claimValidator(array $data)
    {
        return Validator::make($data, [
            'address_line_one' => 'required|string',
            'address_line_two' => 'nullable|string',
            'address_line_three' => 'nullable|string',
            'city' => 'required|string',
            'state' => 'required|string',

            'shirt_size' => 'sometimes|required',
            'back_pack_option' => 'sometimes|required',
            'headphone_option' => 'sometimes|required',
            'smart_watch_option' => 'sometimes|required',
            'three_thousand_cash_option' => 'sometimes|required',
            'ten_thousand_cash_option' => 'sometimes|required',
            'one_year_tuition_option' => 'sometimes|required'
        ]);
    }
}
