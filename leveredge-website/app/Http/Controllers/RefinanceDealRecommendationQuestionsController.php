<?php

namespace App\Http\Controllers;

use App\Events\UserProfileUpdated;
use App\NegotiationGroup;
use App\NegotiationGroupUser;
use App\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;

class RefinanceDealRecommendationQuestionsController extends Controller
{
    protected function setNegotiationGroupUser($negotiationGroupId)
    {
        $negotiationGroup          = NegotiationGroup::findOrFail($negotiationGroupId);
        $negotiationGroupUser      = NegotiationGroupUser::where('user_id',user()->id)->where('academic_year_id',$negotiationGroup->academic_year_id)->first();

        $creditScore               = user()->profile->credit_score;
        $eligibleForFRCreditScores = [
            "700 - 749",
            "750 - 799",
            "Above 800",
        ];
        if (in_array($creditScore,$eligibleForFRCreditScores)) {
            $totalPages = 3;
        } else {
            $totalPages = 1;
        }

        View::share('totalPages', $totalPages);
        View::share('negotiationGroupUser', $negotiationGroupUser);

        return $negotiationGroupUser;
    }

    public function showStartPage(Request $request, $id)
    {
        $this->setNegotiationGroupUser($id);

        return view('member.refinance-deal-recommendation-questions.start-page');
    }

    public function showLoanAmountQuestionPage(Request $request, $id)
    {
        $this->setNegotiationGroupUser($id);

        return view('member.refinance-deal-recommendation-questions.loan-amount-question-page');
    }

    public function showZipCodeQuestionPage(Request $request, $id)
    {
        $this->setNegotiationGroupUser($id);

        return view('member.refinance-deal-recommendation-questions.zip-code-question-page');
    }

    public function storeLoanAmount(Request $request, $id)
    {
        /** @var NegotiationGroupUser $negotiationGroupUser */
        $negotiationGroupUser = $this->setNegotiationGroupUser($id);

        $request->validate([
            'loan_amount' => 'required|integer|gt:0',
        ]);

        // Store Loan Amount in User's Profile
        $user                         = user();
        $negotiationGroupUser->amount = $request->loan_amount;
        $negotiationGroupUser->save();

        // Dispatch User Profile Updated Event
        event(new UserProfileUpdated($user));
        $negotiationGroupUser = $this->setNegotiationGroupUser($id);

        return redirect('member/negotiation-group/' . $negotiationGroupUser->negotiationGroup->id . '/refinance-deal-recommendation-questions/zip-code');
    }

    public function storeZipCode(Request $request, $id)
    {

        $negotiationGroupUser = $this->setNegotiationGroupUser($id);

        $request->validate([
            'zip_code' => 'required|digits:5',
        ]);

        // Store Zip Code in User's Profile
        $user              = user();
        $profile           = $user->profile;
        $profile->zip_code = $request->zip_code;
        $profile->save();

        // Dispatch User Profile Updated Event
        event(new UserProfileUpdated($user));
        $negotiationGroupUser = $this->setNegotiationGroupUser($id);

        return redirect('member/negotiation-group/' . $negotiationGroupUser->negotiationGroup->id . '/refinance-deal-recommendation-questions/medical');
    }

    public function showMedicalQuestionPage(Request $request, $id)
    {
        $professions = $this->getProfessions();
        $this->setNegotiationGroupUser($id);

        return view('member.refinance-deal-recommendation-questions.medical-question-page')->with(compact('professions'));
    }

    public function storeMedical(Request $request, $id)
    {
        $professions = $this->getProfessions();

        $request->validate([
            'profession_id' => 'required|numeric',
        ]);

        $profession_index    = array_search($request->profession_id, array_column($professions,'id'));
        $selected_profession = $professions[$profession_index];

        $user                = user();
        $profile             = $user->profile;
        $profile->is_medical = $selected_profession['valid_for_lr'];
        $profile->save();

        // Dispatch User Profile Updated Event.
        // We fire this event, because we want to "reassess borrower negotiation group"
        event(new UserProfileUpdated($user));
        $negotiationGroupUser = $this->setNegotiationGroupUser($id);

        return redirect('member/negotiation-group/' . $negotiationGroupUser->negotiationGroup->id . '/refinance-deal-recommendation-questions/landing');
    }

//    public function showPage(){
//        $negotiationGroupUser = $this->setNegotiationGroupUser($id);
//        switch($negotiationGroupUser->negotiation_group_id){
//            case NegotiationGroup::NG_MEDICAL_IN_FR_CITIES:
//                $view = '';
//                break;
//
//            case NegotiationGroup::NG_NON_MEDICAL_IN_FR_CITIES:
//                $view = '';
//                break;
//
//            case NegotiationGroup::NG_MEDICAL_OUTSIDE_FR_CITIES:
//                $view = '';
//                break;
//
//            case NegotiationGroup::NG_NON_MEDICAL_OUTSIDE_FR_CITIES:
//                $view = '';
//                break;
//        }
//
//        return view($view);
//    }

    private function getProfessions()
    {
        return [
            [
                'id'           => 1,
                'name'         => 'Physician',
                'valid_for_lr' => true,
            ],
            [
                'id'           => 2,
                'name'         => 'Dentist',
                'valid_for_lr' => true,
            ],
            [
                'id'           => 3,
                'name'         => 'Nurse',
                'valid_for_lr' => true,
            ],
            [
                'id'           => 4,
                'name'         => 'Physician Assistant',
                'valid_for_lr' => true,
            ],
            [
                'id'           => 5,
                'name'         => 'Optometry',
                'valid_for_lr' => true,
            ],
            [
                'id'           => 6,
                'name'         => 'None of the above',
                'valid_for_lr' => false,
            ],
        ];
    }

    public function showLandingPage(Request $request, $id)
    {
        $negotiationGroupUser = $this->setNegotiationGroupUser($id);
        $properties           = [
            'completed_refinance_deal_recommendation_questions' => true,
        ];
        $negotiationGroupUser->properties = $properties;
        $negotiationGroupUser->save();

        return view('member.refinance-deal-recommendation-questions.landing-page');
    }
}
