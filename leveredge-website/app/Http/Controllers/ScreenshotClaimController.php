<?php

namespace App\Http\Controllers;

use App\File;
use App\Notifications\ScreenshotClaimNotification;
use App\PaymentMethod;
use App\ScreenshotClaim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ScreenshotClaimController extends Controller
{
    public function index()
    {
        $rewardClaims       = user()->screenshotClaims;

        return view('screenshot-claim.index')->with(compact(
            'rewardClaims'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fileId' => 'required|exists:files,id',
        ]);

        $screenshotClaim                    = new ScreenshotClaim();
        $screenshotClaim->user_id           = user()->id;
        $screenshotClaim->payment_method_id = PaymentMethod::whereName(PaymentMethod::PAYMENT_METHOD_AMAZON_GIFT_CARD)->first()->id;
        $screenshotClaim->amount            = 0;
        $screenshotClaim->save();
        $user = user();

        if ($request->filled('fileId')) {
            $file = File::find($request->get('fileId'));
            $file->update([
                'fileable_type' => ScreenshotClaim::class,
                'fileable_id'   => $screenshotClaim->id,
            ]);
        }

        $user->load('screenshotClaims');
        Notification::route('slack', config('services.slack.screenshot_reward_claim_url'))
            ->notify(new ScreenshotClaimNotification($screenshotClaim));

        return response()->json([
            'rewardClaims' => $user->screenshotClaims,
        ]);
    }
}
