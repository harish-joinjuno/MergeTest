<?php

namespace App\Http\Controllers;

use App\AcademicYear;
use App\ActionNotifications\DisplayActionNotifications;
use App\Deal;
use App\DealStatus;
use App\Experiment;
use App\ExperimentType;
use App\FaqGroup;
use App\File;
use App\Http\Requests\RewardClaimRequest;
use App\LeveredgeRewardClaim;
use App\NegotiationGroup;
use App\NegotiationGroupUser;
use App\Payment;
use App\PaymentMethod;
use App\RewardPrograms\Concretes\EarnestRefinanceLoanRewardProgram;
use App\RewardPrograms\Concretes\SplashRewardProgram;
use App\Traits\ManagesExperimentParticipation;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class DealShowcaseController extends Controller
{
    use ManagesExperimentParticipation;

    protected function setNegotiationGroupUser($negotiationGroupId)
    {
        $negotiationGroupUser = NegotiationGroupUser::where('user_id',user()->id)->where('negotiation_group_id',$negotiationGroupId)->first();
        View::share('negotiationGroupUser',$negotiationGroupUser);
        DisplayActionNotifications::all();

        return $negotiationGroupUser;
    }

    public function showRecommendedDeal( Request $request ,$negotiationGroupId)
    {
        /** @var User $user */
        /** @var NegotiationGroupUser $negotiationGroupUser */
        $user                 = user();
        $negotiationGroupUser = $this->setNegotiationGroupUser($negotiationGroupId);

        $requires_pre_deal_recommendation_questions = [
            NegotiationGroup::NG_DOMESTIC_CB_ELIGIBLE,
            NegotiationGroup::NG_DOMESTIC_NON_CB_GRAD,
            NegotiationGroup::NG_INTERNATIONAL_WITH_US_COSIGNER,
        ];
        // Redirect to Pre Deal Recommendation Questions if Needed
        if ( in_array($negotiationGroupUser->negotiation_group_id, $requires_pre_deal_recommendation_questions ) ) {
            $properties = $negotiationGroupUser->properties;
            if (!(
                $properties
                && array_key_exists('completed_pre_deal_recommendation_questions' , $properties)
                && $properties['completed_pre_deal_recommendation_questions'])
            ) {
                return redirect('member/negotiation-group/' . $negotiationGroupId . '/pre-deal-recommendation-questions');
            }
        }


        $requires_refinance_deal_recommendation_questions = [
            NegotiationGroup::NG_DOMESTIC_REFINANCE,
            NegotiationGroup::NG_MEDICAL_IN_FR_CITIES,
            NegotiationGroup::NG_MEDICAL_OUTSIDE_FR_CITIES,
            NegotiationGroup::NG_NON_MEDICAL_IN_FR_CITIES,
            NegotiationGroup::NG_NON_MEDICAL_OUTSIDE_FR_CITIES,
        ];
        // Redirect to Refinance Deal Recommendation Questions if Needed
        if ( in_array($negotiationGroupUser->negotiation_group_id, $requires_refinance_deal_recommendation_questions ) ) {
            $properties = $negotiationGroupUser->properties;
            if (!(
                $properties
                && array_key_exists('completed_refinance_deal_recommendation_questions' , $properties)
                && $properties['completed_refinance_deal_recommendation_questions'])
            ) {
                return redirect('member/negotiation-group/' . $negotiationGroupId . '/refinance-deal-recommendation-questions');
            }
        }

        if ($negotiationGroupUser->negotiationGroup->redirect_url) {
            return redirect()->to($negotiationGroupUser->negotiationGroup->redirect_url);
        }

        switch ($negotiationGroupUser->negotiation_group_id) {
            case NegotiationGroup::NG_DOMESTIC_CB_ELIGIBLE:
            case NegotiationGroup::NG_INTERNATIONAL_WITH_US_COSIGNER:
            case NegotiationGroup::NG_DOMESTIC_NON_CB_GRAD:
                if ($user->profile->open_to_variable_rates) {
                    return redirect('member/negotiation-group/' . $negotiationGroupUser->negotiation_group_id . '/variable-deal');
                }

                return redirect('member/negotiation-group/' . $negotiationGroupUser->negotiation_group_id . '/fixed-deal');

            case NegotiationGroup::NG_NON_MEDICAL_OUTSIDE_FR_CITIES:
                /** @var Experiment $experiment */
                $experiment = $this->getOrAssignExperimentOfType(ExperimentType::REFINANCE_RECOMMENDATION_PAGE);

                switch ($experiment->id) {
                    case Experiment::RRP_SIGNING_BONUS:
                        return redirect('/member/negotiation-group/' . $negotiationGroupUser->negotiation_group_id . '/recommended-deals/v2');

                    case Experiment::RRP_DEALS_GUARANTEE:
                        return redirect('/member/negotiation-group/' . $negotiationGroupUser->negotiation_group_id . '/recommended-deals/v3');

                    case Experiment::RRP_DYNAMIC_REWARDS:
                        return redirect('/member/negotiation-group/' . $negotiationGroupUser->negotiation_group_id . '/recommended-deals/v4');

                    case Experiment::RRP_CONTROL:
                    default:
                        return redirect('/member/negotiation-group/' . $negotiationGroupUser->negotiation_group_id . '/recommended-deals');
                }

            default:
                /** @noinspection PhpUnhandledExceptionInspection */
                throw new \Exception('Oops! Let us know and we will get this resolved');
        }
    }

    public function showGbgHealthInsuranceDeal(Request $request ,$negotiationGroupId)
    {
        $this->setNegotiationGroupUser($negotiationGroupId);
        $faqs                 = FaqGroup::find(FaqGroup::INTERNATIONAL_HEALTH_INSURANCE)->questions;

        $referredMembersPending = User::where('referred_by_id',user()->id)->whereHas('negotiationGroupUsers', function (Builder $query) {
            $query->where('negotiation_group_id',NegotiationGroup::NG_ELIGIBLE_FOR_GBG_HEALTH_INSURANCE);
        })->whereDoesntHave('accessTheDeals', function (Builder $query) {
            $query
            ->where('deal_id',Deal::DEAL_INTERNATIONAL_HEALTH_INSURANCE_20_ID)
            ->where('loan_status_id',DealStatus::SIGNED_THE_LOAN);
        })->get();

        $referredMembersTakenDeal = User::where('referred_by_id',user()->id)->whereHas('accessTheDeals', function (Builder $query) {
            $query
                ->where('deal_id',Deal::DEAL_INTERNATIONAL_HEALTH_INSURANCE_20_ID)
                ->where('loan_status_id',DealStatus::SIGNED_THE_LOAN);
        })->take(5)->get();

        return view('member.deal.gbg-health-insurance.gbg_deal_detail_page')->with(
            [
                'faqs'                              => $faqs,
                'referredMembersPending'            => $referredMembersPending,
                'referredMembersTakenDeal'          => $referredMembersTakenDeal,
            ]
        );
    }

    public function showAlternateToFirstRepublicRefinanceDeal(Request $request ,$negotiationGroupId)
    {
        $this->setNegotiationGroupUser($negotiationGroupId);
        $faqs = FaqGroup::find(FaqGroup::RECOMMENDED_NON_MEDICAL_OUTSIDE_FR_CITIES_REFI)->questions;
        $view = 'member.refinance-non-medical-outside-fr-cities.recommended';

        return view($view)->with(
            [
                'faqs'       => $faqs,
            ]
        );
    }

    public function showRecommendedDeals(Request $request ,$negotiationGroupId)
    {
        $negotiationGroupUser = $this->setNegotiationGroupUser($negotiationGroupId);

        switch ($negotiationGroupUser->negotiation_group_id) {

            case NegotiationGroup::NG_MEDICAL_IN_FR_CITIES:
                $faqs = FaqGroup::find(FaqGroup::RECOMMENDED_MEDICAL_IN_FR_CITIES_REFI)->questions;
                $view = 'member.refinance-medical-in-fr-cities.recommended';

                break;

            case NegotiationGroup::NG_MEDICAL_OUTSIDE_FR_CITIES:
                $faqs = FaqGroup::find(FaqGroup::RECOMMENDED_MEDICAL_OUTSIDE_FR_CITIES_REFI)->questions;
                $view = 'member.refinance-medical-outside-fr-cities.recommended';

                break;

            case NegotiationGroup::NG_NON_MEDICAL_IN_FR_CITIES:
                $faqs = FaqGroup::find(FaqGroup::RECOMMENDED_NON_MEDICAL_IN_FR_CITIES_REFI)->questions;
                $view = 'member.refinance-non-medical-in-fr-cities.recommended';

                break;

            case NegotiationGroup::NG_NON_MEDICAL_OUTSIDE_FR_CITIES:
                $faqs = FaqGroup::find(FaqGroup::RECOMMENDED_NON_MEDICAL_OUTSIDE_FR_CITIES_REFI)->questions;
                $view = 'member.refinance-non-medical-outside-fr-cities.recommended';

                break;

            default:
                return redirect()->route('member.dashboard');

        }

        return view($view)->with(
            [
                'faqs'       => $faqs,
            ]
        );
    }

    public function showRecommendedDealsExperiment(Request $request ,$negotiationGroupId, $version)
    {
        $negotiationGroupUser = $this->setNegotiationGroupUser($negotiationGroupId);
        $data                 = [];
        switch ($negotiationGroupUser->negotiation_group_id) {
            case NegotiationGroup::NG_NON_MEDICAL_OUTSIDE_FR_CITIES:
                $faqs = FaqGroup::find(FaqGroup::RECOMMENDED_NON_MEDICAL_OUTSIDE_FR_CITIES_REFI)->questions;
                switch ($version) {
                    case 'v2':
                        $view = 'member.refinance-non-medical-outside-fr-cities.recommended-v2';

                        break;
                    case 'v3':
                        $view = 'member.refinance-non-medical-outside-fr-cities.recommended-v3';

                        break;
                    case 'v4':
                        $splashRewardBtnText  = 'Check your rate';
                        $earnestRewardBtnText = 'Check your rate';
                        if ($negotiationGroupUser->amount) {
                            $splashRewardAmount  = SplashRewardProgram::calculateOverallReward($negotiationGroupUser->amount);
                            $earnestRewardAmount = EarnestRefinanceLoanRewardProgram::calculateOverallReward($negotiationGroupUser->amount);

                            $splashRewardBtnText  = "Unlock your \${$splashRewardAmount} reward";
                            $earnestRewardBtnText = "Unlock your \${$earnestRewardAmount} reward";

                            if ($splashRewardAmount === 0 ) {
                                $splashRewardBtnText = "Compare your other options";
                            }
                            if($earnestRewardAmount === 0) {
                                $earnestRewardBtnText = "Compare your other options";
                            }
                        }
                        $data['splash_reward_text']    = $splashRewardBtnText;
                        $data['earnest_reward_text']   = $earnestRewardBtnText;
                        $view                          = 'member.refinance-non-medical-outside-fr-cities.recommended-v4';

                        break;
                    default:
                        return abort(404);
                }

                break;

            default:
                return redirect()->route('member.dashboard');
        }
        $data['faqs'] = $faqs;

        return view($view)->with($data);
    }

    public function earnestRefinanceDealWithNormalRewards(Request $request ,$negotiationGroupId)
    {
        $this->setNegotiationGroupUser($negotiationGroupId);
        $faqs                 = FaqGroup::find(FaqGroup::EARNEST_DEAL_DETAIL_PAGE_REFI)->questions;

        return view('member.deal.earnest-refinance.deal_detail_page_normal_reward')->with(
            [
                'faqs'       => $faqs,
            ]
        );
    }

    public function earnestRefinanceDealWithAlternateRewards(Request $request ,$negotiationGroupId)
    {
        $this->setNegotiationGroupUser($negotiationGroupId);
        $faqs                 = FaqGroup::find(FaqGroup::EARNEST_DEAL_DETAIL_PAGE_REFI)->questions;

        return view('member.deal.earnest-refinance.deal_detail_page_other_reward')->with(
            [
                'faqs'       => $faqs,
            ]
        );
    }

    public function showLaurelRoadRefinanceDeal(Request $request ,$negotiationGroupId)
    {
        $negotiationGroupUser = $this->setNegotiationGroupUser($negotiationGroupId);

        $can_see_lr_refinance_deal = [
            NegotiationGroup::NG_MEDICAL_OUTSIDE_FR_CITIES,
            NegotiationGroup::NG_MEDICAL_IN_FR_CITIES,
        ];

        if ( in_array($negotiationGroupUser->negotiation_group_id, $can_see_lr_refinance_deal) ) {
            $faqs                 = FaqGroup::find(FaqGroup::LAUREL_ROAD_DEAL_DETAIL_PAGE_REFI)->questions;
            $back_param           = $request->has('back_param') ? $request->get('back_param') : null;

            return view('laurel-road-refinance-deal')->with(
                [
                    'faqs'       => $faqs,
                    'back_param' => $back_param,
                ]
            );
        }

        return redirect()->route('member.dashboard');
    }

    public function showEarnestRefinanceDeal(Request $request ,$negotiationGroupId)
    {
        $negotiationGroupUser = $this->setNegotiationGroupUser($negotiationGroupId);

        $can_see_earnest_refinance_deal = [
            NegotiationGroup::NG_NON_MEDICAL_OUTSIDE_FR_CITIES,
            NegotiationGroup::NG_NON_MEDICAL_IN_FR_CITIES,
        ];

        if ( in_array($negotiationGroupUser->negotiation_group_id, $can_see_earnest_refinance_deal) ) {
            $faqs                 = FaqGroup::find(FaqGroup::EARNEST_DEAL_DETAIL_PAGE_REFI)->questions;
            $back_param           = $request->has('back_param') ? $request->get('back_param') : null;

            return view('earnest-refinance-deal')->with(
                [
                    'faqs'       => $faqs,
                    'back_param' => $back_param,
                ]
            );
        }

        return redirect()->route('member.dashboard');
    }

    public function showRecommendedVariableDeal(Request $request ,$negotiationGroupId)
    {
        $negotiationGroupUser = $this->setNegotiationGroupUser($negotiationGroupId);

        switch ($negotiationGroupUser->negotiation_group_id) {
            case NegotiationGroup::NG_DOMESTIC_CB_ELIGIBLE:
                $faqs                 = FaqGroup::find(FaqGroup::RECOMMENDED_VARIABLE_FOR_CB_ELIGIBLE)->questions;

                return view('member.us-persons-at-cb-eligible-programs-20-21.recommended-deal-variable')
                    ->with([
                        'faqs'                 => $faqs,
                        'negotiationGroupUser' => $negotiationGroupUser,
                    ]);

            case NegotiationGroup::NG_DOMESTIC_NON_CB_GRAD:
            case NegotiationGroup::NG_INTERNATIONAL_WITH_US_COSIGNER:
                $faqs                 = FaqGroup::find(FaqGroup::RECOMMENDED_VARIABLE_FOR_NON_CB_GRADS)->questions;

                return view('member.us-persons-at-non-cb-eligible-grad-programs-20-21.recommended-deal-variable')
                    ->with([
                        'faqs'                 => $faqs,
                        'negotiationGroupUser' => $negotiationGroupUser,
                    ]);

            default:
        }
        abort(404);
    }

    public function showRecommendedFixedDeal(Request $request ,$negotiationGroupId)
    {
        $negotiationGroupUser = $this->setNegotiationGroupUser($negotiationGroupId);


        switch ($negotiationGroupUser->negotiation_group_id) {
            case NegotiationGroup::NG_DOMESTIC_CB_ELIGIBLE:
                $faqs                 = FaqGroup::find(FaqGroup::RECOMMENDED_FIXED_FOR_CB_ELIGIBLE)->questions;

                return view('member.us-persons-at-cb-eligible-programs-20-21.recommended-deal-fixed')
                    ->with([
                        'faqs'                 => $faqs,
                        'negotiationGroupUser' => $negotiationGroupUser,
                    ]);

            case NegotiationGroup::NG_DOMESTIC_NON_CB_GRAD:
            case NegotiationGroup::NG_INTERNATIONAL_WITH_US_COSIGNER:
                $faqs                 = FaqGroup::find(FaqGroup::RECOMMENDED_FIXED_FOR_NON_CB_GRADS)->questions;

                return view('member.us-persons-at-non-cb-eligible-grad-programs-20-21.recommended-deal-fixed')
                    ->with([
                        'faqs'                 => $faqs,
                        'negotiationGroupUser' => $negotiationGroupUser,
                    ]);

            default:
        }
        abort(404);
    }

    public function earnestUndergraduateDeal(Request $request ,$negotiationGroupId)
    {
        $negotiationGroupUser = $this->setNegotiationGroupUser($negotiationGroupId);


        $can_see_earnest_undergrad_deal = [
            NegotiationGroup::NG_DOMESTIC_UNDERGRAD,
        ];

        if ( in_array($negotiationGroupUser->negotiation_group_id, $can_see_earnest_undergrad_deal) ) {
            $faqs                 = FaqGroup::find(FaqGroup::EARNEST_DEAL_DETAIL_PAGE_UNDERGRAD)->questions;
            $back_param           = $request->has('back_param') ? $request->get('back_param') : null;

            return view('earnest-undergraduate-deal')->with(
                [
                    'faqs'       => $faqs,
                    'back_param' => $back_param,
                ]
            );
        }

        return redirect()->route('member.dashboard');
    }

    public function earnestGraduateDeal(Request $request ,$negotiationGroupId)
    {
        $negotiationGroupUser = $this->setNegotiationGroupUser($negotiationGroupId);

        $can_see_earnest_grad_deal = [
            NegotiationGroup::NG_DOMESTIC_CB_ELIGIBLE,
            NegotiationGroup::NG_DOMESTIC_NON_CB_GRAD,
            NegotiationGroup::NG_INTERNATIONAL_WITH_US_COSIGNER,
        ];

        // If they can see the deal, show it, else redirect them to the dashboard.
        if ( in_array($negotiationGroupUser->negotiation_group_id, $can_see_earnest_grad_deal) ) {
            $faqs                 = FaqGroup::find(FaqGroup::EARNEST_DEAL_DETAIL_PAGE_GRAD)->questions;
            $back_param           = $request->has('back_param') ? $request->get('back_param') : null;

            return view('earnest-graduate-deal')->with(
                [
                    'faqs'       => $faqs,
                    'back_param' => $back_param,
                ]
            );
        }

        return redirect()->route('member.dashboard');
    }

    public function commonbondMbaDeal(Request $request ,$negotiationGroupId)
    {
        $negotiationGroupUser = $this->setNegotiationGroupUser($negotiationGroupId);

        $can_see_commonbond_grad_deal = [
            NegotiationGroup::NG_DOMESTIC_CB_ELIGIBLE,
        ];

        // If they can see the deal, show it, else redirect them to the dashboard.
        if ( in_array($negotiationGroupUser->negotiation_group_id, $can_see_commonbond_grad_deal) ) {
            $faqs                 = FaqGroup::find(FaqGroup::COMMONBOND_DEAL_DETAIL_PAGE)->questions;
            $back_param           = $request->has('back_param') ? $request->get('back_param') : null;

            return view('commonbond-mba-deal')->with(
                [
                    'faqs'       => $faqs,
                    'back_param' => $back_param,
                ]
            );
        }

        return redirect()->route('member.dashboard');
    }

    public function credibleGraduateDeal(Request $request ,$negotiationGroupId)
    {
        $negotiationGroupUser = $this->setNegotiationGroupUser($negotiationGroupId);

        $can_see_credible_grad_deal = [
            NegotiationGroup::NG_DOMESTIC_CB_ELIGIBLE,
            NegotiationGroup::NG_DOMESTIC_NON_CB_GRAD,
            NegotiationGroup::NG_INTERNATIONAL_WITH_US_COSIGNER,
        ];

        // If they can see the deal, show it, else redirect them to the dashboard.
        if ( in_array($negotiationGroupUser->negotiation_group_id, $can_see_credible_grad_deal) ) {
            $faqs                 = FaqGroup::find(FaqGroup::CREDIBLE_DEAL_DETAIL_PAGE)->questions;
            $back_param           = $request->has('back_param') ? $request->get('back_param') : null;

            return view('credible-graduate-deal')->with(
                [
                    'faqs'       => $faqs,
                    'back_param' => $back_param,
                ]
            );
        }

        return redirect()->route('member.dashboard');
    }

    public function getMyDeal (Request $request, User $user)
    {
        if (! $request->hasValidSignature()) {
            return redirect('/get-my-deal/please-login');
        }
        Auth::login($user);

        // Figure out their Negotiation Group User (they should have one)
        $negotiationGroupUser = NegotiationGroupUser::where('user_id',$user->id)->where('academic_year_id',3)->firstOrFail();

        // Send the User to that Negotiation group
        return redirect('/member/negotiation-group/' . $negotiationGroupUser->negotiationGroup->id);
    }

    public function getMyRefinanceDeal (Request $request, User $user)
    {
        if (! $request->hasValidSignature()) {
            return redirect('/get-my-deal/please-login');
        }
        Auth::login($user);

        // Figure out their Negotiation Group User (they should have one)
        $negotiationGroupUser = NegotiationGroupUser::where('user_id',$user->id)->where('academic_year_id',1)->firstOrFail();

        // Send the User to that Negotiation group
        return redirect('/member/negotiation-group/' . $negotiationGroupUser->negotiationGroup->id);
    }

    public function pleaseLogin()
    {
        return view('please-login');
    }

    public function firstRepublicRefinanceDeal(Request $request ,$negotiationGroupId)
    {
        $faqs = FaqGroup::find(FaqGroup::FIRST_REPUBLIC_DEAL_DETAIL_PAGE_REFI)->questions;
        $this->setNegotiationGroupUser($negotiationGroupId);

        return view('member.deal.first-republic-refinance.first_republic_deal_detail')->with(compact(
            'faqs'
        ));
    }

    public function showFirstRepublicAndLaurelRoad()
    {
        $negotiationGroupUser = NegotiationGroupUser::where('user_id',user()->id)->where('academic_year_id',1)->firstOrFail();
        View::share('negotiationGroupUser',$negotiationGroupUser);
        $this->setNegotiationGroupUser($negotiationGroupUser->negotiation_group_id);
        $faqs                 = FaqGroup::find(FaqGroup::FIRST_REPUBLIC_DEAL_DETAIL_PAGE_REFI)->questions;

        return view('member.refinance-medical-in-fr-cities.split_recommended')->with(compact(
            'faqs'
        ));
    }

    public function showLaurelRoadDeal(Request $request ,$negotiationGroupId)
    {
        $this->setNegotiationGroupUser($negotiationGroupId);
        $faqs = FaqGroup::find(FaqGroup::LAUREL_ROAD_DEAL_DETAIL_PAGE_REFI)->questions;

        return view('member.refinance-medical-outside-fr-cities.recommended')->with(compact(
            'faqs'
        ));
    }

    public function getInternationalDeal(Request $request, User $user)
    {
        if (! $request->hasValidSignature()) {
            return redirect('/get-my-deal/please-login');
        }

        $profile      = $user->profile;
        $academicYear = AcademicYear::whereName(AcademicYear::ACADEMIC_YEAR_HEALTH_INSURANCE)->first();
        $profile->placeInEligibleNegotiationGroups($academicYear);
        Auth::login($user);

        $negotiationGroupUser = NegotiationGroupUser::where('user_id',$user->id)->where('academic_year_id',$academicYear->id)->firstOrFail();

        return redirect('/member/negotiation-group/' . $negotiationGroupUser->negotiationGroup->id);
    }

    public function getNonMedicalInFrOrSplash(Request $request, User $user)
    {
        if (! $request->hasValidSignature()) {
            return redirect('/get-my-deal/please-login');
        }

        Auth::login($user);

        $academicYear = AcademicYear::whereName(AcademicYear::ACADEMIC_YEAR_REFINANCE)->first();
        /** @var NegotiationGroupUser $negotiationGroupUser */
        $negotiationGroupUser = NegotiationGroupUser::where('user_id',$user->id)->where('academic_year_id',$academicYear->id)->firstOrFail();

        return redirect('/member/negotiation-group/' . $negotiationGroupUser->negotiationGroup->id);
    }

    public function getInternationalStudentsWithNoUniversity(Request $request, User $user)
    {
        session()->put('international_student_update_profile', true);
        if (! $request->hasValidSignature()) {
            return redirect('/get-my-deal/please-login');
        }

        Auth::login($user);

        return redirect('/user-profile/international-student-profile-update');
    }
}
