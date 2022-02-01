<?php

namespace App\Http\Controllers;

use App\ActionNotifications\DisplayActionNotifications;
use App\Http\Requests\ShareViaEmailRequest;
use App\Mail\ReferralProgramShareViaEmail;
use App\PaymentMethod;
use App\ReferralProgramUser;
use App\ReferralRewardClaim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReferralProgramController extends Controller
{
    public function index()
    {
        DisplayActionNotifications::all();
        $referralProgramUsers = user()->referralProgramUsers;

        $currentReferralProgramUser = null;

        /** @var ReferralProgramUser $referralProgramUser */
        foreach ($referralProgramUsers as $referralProgramUser) {
            if ($referralProgramUser->isCurrentReferralProgram()) {
                $currentReferralProgramUser = $referralProgramUser;
                break;
            }
        }

        // TODO: Design a screen that tells the user that they don't have a referral program
        if (!$currentReferralProgramUser) {
            return redirect()->route('user-profile.loan-type');
        }

        $otherReferralProgramUsersWithPendingRewards = $referralProgramUsers->filter(function (ReferralProgramUser $item) {
            return !$item->isCurrentReferralProgram() && ($item->getAmountToBePaid() > 0);
        });

        return view('member.referral-program.referral-program', [
            'referralProgramUser'                         => $currentReferralProgramUser,
            'otherReferralProgramUsersWithPendingRewards' => $otherReferralProgramUsersWithPendingRewards,
            'amountToBePaid'                              => $currentReferralProgramUser->getAmountToBePaid(),
        ]);
    }

    public function show($referralProgramId)
    {
        /** @var ReferralProgramUser $referralProgramUser */
        $referralProgramUser = user()
            ->referralProgramUsers()
            ->where('referral_program_id', '=', $referralProgramId)
            ->first();

        return view('member.referral-program.expired-referral-program', [
            'referralProgramUser' => $referralProgramUser,
        ]);
    }

    public function storeRewardClaim(Request $request)
    {
        $validatedData = $request
            ->validate([
                'referral_program_user_id' => 'required|exists:referral_program_users,id',
                'payment_method'           => 'required|exists:payment_methods,name',
                'amount'                   => 'required|integer|min:1',
            ]);

        /** @var ReferralProgramUser $referralProgramUser */
        $referralProgramUser = ReferralProgramUser::query()->find($validatedData['referral_program_user_id']);
        /** @var PaymentMethod $paymentMethod */
        $paymentMethod = PaymentMethod::query()->where('name', $validatedData['payment_method'])->first();

        $referralRewardClaim                           = new ReferralRewardClaim();
        $referralRewardClaim->referral_program_user_id = $referralProgramUser->id;
        $referralRewardClaim->reward                   = 'For Referrals: As ' . $paymentMethod->name . ' ($' . $referralProgramUser->getAmountToBePaid() . ')';
        $referralRewardClaim->value                    = $referralProgramUser->getAmountToBePaid();
        $referralRewardClaim->save();

        return redirect('/member/referral-program');
    }

    public function shareViaEmail(ShareViaEmailRequest $request)
    {
        foreach ($request->emails as $email) {
            Mail::to($email)->send(new ReferralProgramShareViaEmail(user()));
        }

        return back();
    }
}
