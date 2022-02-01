<?php


namespace App\Http\Controllers;

use App\AcademicYear;
use App\Deal;
use App\Experiment;
use App\ExperimentClient;
use App\ExperimentType;
use App\FaqGroup;
use App\NegotiationGroupUser;
use App\Rate;
use App\Traits\ManagesExperimentParticipation;
use App\User;
use App\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class NewRefiFlowController extends Controller
{
    use ManagesExperimentParticipation;

    public function getRedirectUrl(Request $request)
    {
        $this->getOrAssignExperimentOfType(ExperimentType::SLR_LANDING_PAGE);
        return redirect()->to('/loans/refinance');
    }

    public function newRefiFlow()
    {
        $professions = $this->getProfessions();
        $faqs        = FaqGroup::find(FaqGroup::REFI_LOAN_DETAIL_PAGE)->questions;
        $rates       = Rate::with('rateProperties')->find(Rate::REFI_LOAN_DETAIL_PAGE);

        session()->put('should_be_flow_6', true);

        return view('landing-pages.fast-flow.fast-flow-refinance', [
            'professions' => $professions,
            'faqs'        => $faqs,
            'rates'       => $rates,
        ]);
    }

    public function postAnswers(Request $request)
    {
        $professions               = $this->getProfessions();
        $this->validate($request, [
            'refinance_amount' => 'nullable|numeric',
            'zip_code'         => 'nullable|numeric',
            'profession_id'    => ['nullable', Rule::in(array_column($professions,'id'))],
        ]);
        $user                      = new User();
        $user->email               = Str::random(6) . 'fastRefiFlow@leveredge.org';
        $user->password            = bcrypt('powerinnumbers');
        $profession_index          = array_search($request->get('profession_id'), array_column($professions,'id'));
        $selected_profession       = $professions[$profession_index];

        $user->save();
        $profile = $user->profile()->create([
            'zip_code'           => $request->get('zip_code'),
            'is_medical'         => $selected_profession['valid_for_lr'],
            'immigration_status' => UserProfile::IMMIGRATION_STATUS_US_CITIZEN_OR_PERMANENT_RESIDENT,
        ]);

        if (Cookie::has('tracking_sources')) {
            $trackingSources = unserialize(Cookie::get('tracking_sources'));
            $profile->update($trackingSources);
        }

        $user->userRefiFlow()->create([
            'flow_type' => 4,
        ]);

        $academicYear = AcademicYear::whereName(AcademicYear::ACADEMIC_YEAR_REFINANCE)->first();
        $user->profile->placeInEligibleNegotiationGroups($academicYear);
        $negotiationGroupUser         = NegotiationGroupUser::where('user_id', $user->id)->where('academic_year_id',$academicYear->id)->first();
        $negotiationGroupUser->amount = $request->get('refinance_amount');
        $negotiationGroupUser->save();
        $hasKey = Hash::make($user->id . '-powerinnumbers');
        session()->put('fast_flow_user', $user);

        return redirect()->to('/fast-flow/deal/?key=' . $hasKey);
    }

    public function showDeal()
    {
        /** @var User $user */
        $user  = session('fast_flow_user');
        $rates = null;
        if (Hash::check($user->id . '-powerinnumbers', request()->get('key'))) {
            $academicYear         = AcademicYear::whereName(AcademicYear::ACADEMIC_YEAR_REFINANCE)->first();
            $negotiationGroupUser = NegotiationGroupUser::where('user_id', $user->id)->where('academic_year_id',$academicYear->id)->first();
            if ($negotiationGroupUser->negotiationGroup->slug === 'refinance-medical-outside-fr-cities') {
                $faqs  = FaqGroup::find(FaqGroup::LAUREL_ROAD_DEAL_DETAIL_PAGE_REFI)->questions;
                $rates = Rate::with('rateProperties')->find(Rate::LAUREL_ROAD_DEAL_DETAIL_PAGE_REFI);
            } else {
                $faqs = FaqGroup::find(FaqGroup::RECOMMENDED_NON_MEDICAL_OUTSIDE_FR_CITIES_REFI)->questions;
            }

            return view('landing-pages.fast-flow.deals.' . $negotiationGroupUser->negotiationGroup->slug, [
                'faqs'  => $faqs,
                'rates' => $rates,
            ]);
        }
    }

    public function showLaurelRoadEmailPrompt()
    {
        $url = '/member/deal/' . Deal::DEAL_LAUREL_ROAD_REFINANCE_SLUG . '/hand-off';
        session()->put('fast_flow_skip_url', $url);

        return view('landing-pages.fast-flow.email_prompts.laurel-road', compact('url'));
    }

    public function showEarnestEmailPrompt()
    {
        $dealSlug = Deal::DEAL_EARNEST_REFINANCE_WITH_REWARDS_20_OTHER_STATES_SLUG;
        session()->put('fast_flow_skip_url', url('/member/deal/' . $dealSlug . '/hand-off'));

        return $this->skipEmailStep();
    }

    public function showSplashEmailPrompt()
    {
        $dealSlug = Deal::DEAL_SPLASH_REFINANCE_SLUG;
        session()->put('fast_flow_skip_url', url('/member/deal/' . $dealSlug . '/hand-off'));

        return $this->skipEmailStep();
    }

    public function updateNameAndEmail(Request $request)
    {
        /** @var User $user */
        $user = session()->get('fast_flow_user');

        $this->validate($request, [
            'first_name' => 'required',
            'email'      => 'required|email|unique:users',
        ]);

        $user->first_name = $request->get('first_name');
        $user->email      = $request->get('email');
        $user->save();

        return $this->skipEmailStep();
    }

    public function skipEmailStep()
    {
        /** @var User $user */
        $user = session()->get('fast_flow_user');
        $url  = session()->get('fast_flow_skip_url');

        auth()->loginUsingId($user->id);

        return redirect()->to($url);
    }

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
}
