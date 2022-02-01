<?php

namespace App\Http\Controllers;

use App\NegotiationGroupUser;
use App\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;

class PreDealRecommendationQuestionsController extends Controller
{
    protected function setNegotiationGroupUser($negotiationGroupId)
    {
        $negotiationGroupUser = NegotiationGroupUser::where('user_id',user()->id)->where('negotiation_group_id',$negotiationGroupId)->first();
        View::share('negotiationGroupUser',$negotiationGroupUser);

        return $negotiationGroupUser;
    }

    public function showStartPage(Request $request, $id)
    {
        $this->setNegotiationGroupUser($id);

        return view('member.pre-deal-recommendation-questions.start-page');
    }

    public function showCosignerQuestionPage(Request $request, $id)
    {
        $this->setNegotiationGroupUser($id);

        return view('member.pre-deal-recommendation-questions.co-signer-question-page')->with(
            [
                'cosignerStatuses' => [UserProfile::COSIGNER_STATUS_YES,UserProfile::COSIGNER_STATUS_NO],
            ]
        );
    }

    public function storeCosignerInformation(Request $request, $id)
    {
        $this->setNegotiationGroupUser($id);
        $request->validate([
            'cosigner_status' => [
                    'required',Rule::in(UserProfile::COSIGNER_STATUSES),
                ],
        ]);

        $profile                  = user()->profile;
        $profile->cosigner_status = $request->cosigner_status;
        $profile->save();

        return redirect('member/negotiation-group/' . $id . '/pre-deal-recommendation-questions/variable-rates-page');
    }

    public function showVariableRatesPage(Request $request, $id)
    {
        $this->setNegotiationGroupUser($id);

        return view('member.pre-deal-recommendation-questions.variable-rates-page')->with(
            [
                'variableRates' => [
                    [
                        'display' => 'Yes',
                        'value'   => 1,
                    ],
                    [
                        'display' => 'No',
                        'value'   => 0,
                    ],
                ],
            ]
        );
    }

    public function storeVariableRateInformation(Request $request, $id)
    {
        $this->setNegotiationGroupUser($id);
        $request->validate([
            'open_to_variable_rates' => [
                'required','bool',
            ],
        ]);

        $profile                         = user()->profile;
        $profile->open_to_variable_rates = $request->open_to_variable_rates;
        $profile->save();

        return redirect('member/negotiation-group/' . $id . '/pre-deal-recommendation-questions/landing');
    }

    public function showLandingPage(Request $request, $id)
    {
        $negotiationGroupUser = $this->setNegotiationGroupUser($id);
        $properties           = [
            'completed_pre_deal_recommendation_questions' => true,
        ];
        $negotiationGroupUser->properties = $properties;
        $negotiationGroupUser->save();

        return view('member.pre-deal-recommendation-questions.landing-page');
    }
}
