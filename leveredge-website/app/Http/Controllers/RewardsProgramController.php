<?php

namespace App\Http\Controllers;

use App\Deal;
use App\Experiment;
use App\ExperimentType;
use App\File;
use App\Http\Requests\RewardClaimRequest;
use App\Jobs\SendRewardRequestEmail;
use App\LeveredgeRewardClaim;
use App\Notifications\RewardClaimNotification;
use App\PaymentMethod;
use App\Traits\ManagesExperimentParticipation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class RewardsProgramController extends Controller
{
    use ManagesExperimentParticipation;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function redirectToRewardsClaimForm()
    {
        return redirect(
            'member/reward-claim'
        );
    }

    public function getRewardClaim()
    {
        user()->load('rewardClaims.accessTheDeal');
        $paymentMethods     = PaymentMethod::whereIn('name', [PaymentMethod::PAYMENT_METHOD_DIGITAL_CHECK, PaymentMethod::PAYMENT_METHOD_AMAZON_GIFT_CARD])->get();
        $rewardClaims       = user()->rewardClaims;
        $deals              =
            Deal::whereNotNull('reward_program')->whereHas('accessRecords', function(Builder $query) {
                $query->where('user_id',user()->id);
            })->get();

        return view('reward-claim', compact(
            'deals',
            'paymentMethods',
            'rewardClaims'
        ));
    }

    public function getRewardAmount(Request $request)
    {
        $rewardClaim              = new LeveredgeRewardClaim();
        $rewardClaim->user_id     = user()->id;
        $rewardClaim->deal_id     = $request->deal_id;
        $rewardClaim->loan_amount = $request->loan_amount;
        $rewardAmount             = $rewardClaim->calculateRewardAmount();

        return response()->json([
            'rewardAmount' => $rewardAmount,
        ]);
    }

    public function postRewardClaim(RewardClaimRequest $request)
    {
        $rewardClaim                         = new LeveredgeRewardClaim();
        $rewardClaim->user_id                = user()->id;
        $rewardClaim->deal_id                = $request->deal_id;
        $rewardClaim->payment_method_id      = $request->payment_method_id;
        $rewardClaim->loan_amount            = $request->loan_amount;
        $rewardClaim->reward_amount          = $rewardClaim->calculateRewardAmount();
        $rewardClaim->credit_score           = $request->credit_score;
        $rewardClaim->cosigner_credit_score  = $request->cosigner_credit_score;
        $rewardClaim->annual_income          = $request->annual_income;
        $rewardClaim->cosigner_annual_income = $request->cosigner_annual_income;
        $rewardClaim->save();
        $user = user();

        if ($request->filled('fileId')) {
            $file = File::find($request->get('fileId'));
            $file->update([
                'fileable_type' => LeveredgeRewardClaim::class,
                'fileable_id'   => $rewardClaim->id,
            ]);
        }
        $user->load('rewardClaims');

        dispatch( new SendRewardRequestEmail($user) );
        Notification::route('slack', config('services.slack.leveredge_reward_claim_url'))
            ->notify(new RewardClaimNotification($rewardClaim));

        return response()->json([
            'rewardClaims' => $user->rewardClaims,
        ]);
    }

    public function success()
    {
        $experiment = $this->getOrAssignExperimentOfType(ExperimentType::POST_REWARD_CLAIM);

        switch ($experiment->id) {
            case Experiment::POST_REWARD_CLAIM_V2:
                return redirect('member/reward-claim/success/v2');

            case Experiment::POST_REWARD_CLAIM_V3:
                return redirect('member/reward-claim/success/v3');
        }

        return view('reward-program.v1', [
            'shareUrl'            => user()->referral_link,
            'shareTitle'          => 'Join Juno now!',
            'referralProgramUser' => user()->currentReferralProgramUser(),
        ]);
    }

    public function successV2()
    {
        $this->getOrAssignExperimentOfType(ExperimentType::POST_REWARD_CLAIM);

        return view('reward-program.v2', [
            'shareUrl'            => user()->referral_link,
            'shareTitle'          => 'Join Juno now!',
            'referralProgramUser' => user()->currentReferralProgramUser(),
        ]);
    }

    public function successV3()
    {
        $this->getOrAssignExperimentOfType(ExperimentType::POST_REWARD_CLAIM);

        return view('reward-program.v3', [
            'shareUrl'            => user()->referral_link,
            'shareTitle'          => 'Join Juno now!',
            'referralProgramUser' => user()->currentReferralProgramUser(),
        ]);
    }
}

