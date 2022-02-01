<?php

namespace App\Http\Controllers;

use App\AccessTheDeal;
use App\Deal;
use App\DealStatus;
use App\Events\AccessTheDealStatusUpdated;
use App\Jobs\AddTagInMailchimp;
use App\Jobs\ReportFirstClickToDealToFacebookAsAddToCart;
use App\Jobs\SendClickedToDealEmail;
use Illuminate\Http\Request;


class DealHandOffController extends Controller
{
    public function handOff(Request $request, $deal_slug)
    {
        /** @var Deal $deal */
        $deal = Deal::where('slug',$deal_slug)->firstOrFail();

        $access_the_deal                 = new AccessTheDeal();
        $access_the_deal->deal_id        = $deal->id;
        $access_the_deal->loan_status_id = DealStatus::DEFAULT_DEAL_STATUS_ID;
        $access_the_deal->user_id        = user()->id;
        $access_the_deal->save();

        dispatch(((new AddTagInMailchimp($request->user(),'clicked-to-deal-' . $deal->slug))))->delay(now()->addMinutes(5));

        $hasHandOffScreen = [
            Deal::DEAL_EARNEST_GRAD_STUDENT_LOAN_20_21_SLUG,
            Deal::DEAL_COMMONBOND_MBA_STUDENT_LOAN_20_21_SLUG,
        ];

        dispatch(new SendClickedToDealEmail($deal));

        $url = $access_the_deal->getRedirectUrl();

        event(new AccessTheDealStatusUpdated($access_the_deal->user, $access_the_deal));

        if ( in_array( $deal_slug, $hasHandOffScreen) ) {
            return view('deal.handoff.' . $deal_slug)->with('url',$url);
        }

        $this->dispatch(new ReportFirstClickToDealToFacebookAsAddToCart($access_the_deal));

        return redirect($url);
    }

    public function earnestHandOffTwo()
    {
        return view('deal.handoff.earnest-graduate-loan-20-21-2');
    }
}
