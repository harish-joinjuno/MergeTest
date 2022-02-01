<?php

namespace App\Http\Controllers;

use App\Affiliate;
use App\Jobs\AddTagInMailchimp;
use App\MarketingEmailUnsubscribe;
use App\UnsubscribeRequest;
use App\User;
use Illuminate\Http\Request;

class UnsubscribeController extends Controller
{
    public function index(Request $request)
    {
        return view('unsubscribe.index')
            ->with('email',$request->email);
    }

    public function update(Request $request)
    {

        // Validate the Request
        $request->validate([
            'email'  => 'required|email|max:255',
            'reason' => 'required',
        ]);

        // Store the Unsubscribe Request
        $unsubscribe_request         = new UnsubscribeRequest();
        $unsubscribe_request->email  = $request->email;
        $unsubscribe_request->reason = $request->reason;
        $unsubscribe_request->save();

        $user = User::where('email',$unsubscribe_request->email)->firstOrFail();

        // Update their Preferences in MailChimp
        if ($request->has('unsub_from_student_loan_deal_emails')) {
            dispatch( new AddTagInMailchimp($user,'no-more-student-loan-deal-emails') )->delay(10);
        }

        if ($request->has('unsub_from_refinance_loan_deal_emails')) {
            dispatch( new AddTagInMailchimp($user,'no-more-refinance-deal-emails') )->delay(10);
        }

        if ($request->has('unsub_from_join_juno_emails')) {
            dispatch( new AddTagInMailchimp($user,'no-more-join-juno-emails') )->delay(10);
        }

        if ($request->has('unsub_from_all_emails')) {
            dispatch( new AddTagInMailchimp($user,'no-more-student-loan-deal-emails') )->delay(10);
            dispatch( new AddTagInMailchimp($user,'no-more-refinance-deal-emails') )->delay(10);
            dispatch( new AddTagInMailchimp($user,'no-more-join-juno-emails') )->delay(10);
            dispatch( new AddTagInMailchimp($user,'no-more-student-loan-or-refinance-emails') )->delay(10);
        }

        session()->flash('unsubscribe_success', true);
        return redirect()->to('/unsubscribe/success');
    }

    public function success()
    {
        if (session()->get('unsubscribe_success')) {
            return view('unsubscribe.success');
        }

        return redirect()->to('/');
    }

    public function manualUnsubscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
        ]);

        MarketingEmailUnsubscribe::firstOrcreate([
            'email'            => $request->email,
            'has_unsubscribed' => true,
            'reason'           => MarketingEmailUnsubscribe::USER_INITIATED_UNSUBSCRIBE,
        ]);

        return view('unsubscribe.success');
    }
}
