<?php

namespace App\Http\Controllers;

use App\PartnerClaim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class PartnerClaimController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'payment_method_id' => 'required',
        ]);

        $partner         = user();
        $amountToBePaid  = 0;
        $earnedAmount    = $partner->partnerProfile->contract_type->calculateEarnedAmount($partner);
        $claimedAmount   = $partner->partnerClaims()->sum('amount');
        if ($earnedAmount > 0) {
            $amountToBePaid  = max($earnedAmount-$claimedAmount, 0);
        }

        if (($amountToBePaid + $claimedAmount ) > $earnedAmount) {
            return redirect()->back()->withErrors(['Claim limit reached']);
        }

        PartnerClaim::create([
            'partner_id'           => user()->id,
            'payment_method_id'    => $request->payment_method_id,
            'amount'               => $amountToBePaid,
        ]);

        return redirect()->back();
    }
}
