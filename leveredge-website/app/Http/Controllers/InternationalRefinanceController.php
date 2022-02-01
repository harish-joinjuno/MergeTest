<?php

namespace App\Http\Controllers;

use App\AcademicYear;
use App\Country;
use App\Degree;
use App\Events\UserPlacedInNegotiationGroup;
use App\Http\Requests\InternationalRefinanceGradRequest;
use App\Http\Requests\InternationalRefinanceUndergradRequest;
use App\MailchimpAutomatedCampaignUser;
use App\NegotiationGroupUser;
use App\University;
use App\UserProfile;
use App\Visa;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InternationalRefinanceController extends Controller
{
    public function profileEducationInfoShow()
    {
        $totalSteps  = 5;
        $currentStep = 1;
        $yes_no      = [
            'yes' => 'Yes',
            'no'  => 'No',
        ];

        return view('user_profile.international_refinance.education',
            compact( 'yes_no', 'totalSteps', 'currentStep'));
    }

    public function profileEducationInfo(Request $request)
    {
        $request->validate(['went_to_graduate_school' => 'required']);
        user()->profile->went_to_graduate_school = $request->went_to_graduate_school;
        user()->profile->save();
        //$request->persistWithProgress();

        return redirect()->route('user-profile.undergraduate-info');
    }

    public function profileUndergraduateInfoShow()
    {
        if (user()->profile->went_to_graduate_school == 'yes') {
            return redirect()->route('user-profile.graduate-info');
        }
        $totalSteps   = 5;
        $currentStep  = 2;
        $universities = University::orderBy('name')->get();

        $degrees = Degree::query()
            ->undergraduate()
            ->orderBy('name')
            ->get();

        $countries        = Country::all();

        return view('user_profile.international_refinance.undergraduate',
            compact('currentStep','totalSteps', 'universities', 'degrees', 'countries'));
    }

    public function profileUndergraduateInfo(InternationalRefinanceUndergradRequest $request)
    {
        if ($request->university_id != 'Other') {
            user()->profile->university_id = $request->university_id;
        }
        user()->profile->degree_id     = $request->degree_id;
        if ($request->has('university_country_id')) {
            user()->profile->university_country_id = $request->university_country_id;
        }
        user()->profile->undergraduate_month_year = $request->undergraduate_month_year;
        user()->profile->save();
        //$request->persistWithProgress();

        return redirect()->route('user-profile.income-info');
    }

    public function profileGraduateInfoShow()
    {
        $totalSteps   = 5;
        $currentStep  = 2;
        $universities = University::orderBy('name')->get();

        $degrees = Degree::query()
            ->graduate()
            ->orderBy('name')
            ->get();

        $countries        = Country::all();

        return view('user_profile.international_refinance.graduate',
            compact('currentStep','totalSteps', 'universities', 'degrees', 'countries'));
    }

    public function profileGraduateInfo(InternationalRefinanceGradRequest $request)
    {
        user()->profile->grad_university_id          = $request->grad_university_id;
        user()->profile->grad_degree_id              = $request->grad_degree_id;
        if ($request->has('grad_university_country_id')) {
            user()->profile->grad_university_country_id = $request->grad_university_country_id;
        }
        user()->profile->graduate_month_year = $request->graduate_month_year;
        user()->profile->save();
        //$request->persistWithProgress();

        return redirect()->route('user-profile.income-info');
    }

    public function profileIncomeInfoShow()
    {
        $totalSteps  = 5;
        $currentStep = 3;

        $yes_no = [
            'yes' => 'Yes',
            'no'  => 'No',
        ];

        $countries        = Country::all();

        return view('user_profile.international_refinance.income',
            compact('currentStep','totalSteps', 'yes_no', 'countries'));
    }

    public function profileIncomeInfo(Request $request)
    {
        $request->validate([
            'employed'                      => 'required_without:full_time_offer',
            'total_annual_compensation'     => 'required_without:expected_annual_compensation',
            'full_time_offer'               => 'required_without:employed',
            'expected_annual_compensation'  => 'required_without:total_annual_compensation',
            'employer_name'                 => 'required_if:employed,yes|required_if:full_time_offer,yes',
            'employment_start_date'         => 'required_if:employed,yes|required_if:full_time_offer,yes',
            'employment_country_id'         => 'required_if:employed,yes|required_if:full_time_offer,yes',
        ]);

        user()->profile->employed                     = $request->employed;
        user()->profile->total_annual_compensation    = $request->total_annual_compensation;
        user()->profile->full_time_offer              = $request->full_time_offer;
        user()->profile->expected_annual_compensation = $request->expected_annual_compensation;
        user()->profile->employer_name                = $request->employer_name;
        user()->profile->employment_start_date        = $request->employment_start_date;
        user()->profile->employment_country_id        = $request->employment_country_id;
        user()->profile->other_yearly_income          = $request->other_yearly_income;
        user()->profile->save();

        //$request->persistWithProgress();
        return redirect()->route('user-profile.loan-info');
    }

    public function profileLoanInfoShow()
    {
        $totalSteps  = 5;
        $currentStep = 4;

        $yes_no = [
            'yes' => 'Yes',
            'no'  => 'No',
        ];

        $fixed_variable = [
            'fixed'     => 'Fixed',
            'variable'  => 'Variable',
        ];

        return view('user_profile.international_refinance.loan',
            compact('currentStep','totalSteps', 'yes_no', 'fixed_variable'));
    }

    public function profileLoanInfo(Request $request)
    {
        $request->validate([
            'refinance_amount'      => 'required',
            'lender_name'           => 'required',
            'currency'              => 'required',
            'collateralized_loan'   => 'required',
            'current_interest_rate' => 'nullable|numeric|between:0,99.99',
        ]);

        user()->profile->refinance_amount               = $request->refinance_amount;
        user()->profile->lender_name                    = $request->lender_name;
        user()->profile->currency                       = $request->currency;
        user()->profile->collateralized_loan            = $request->collateralized_loan;
        user()->profile->current_interest_rate          = $request->current_interest_rate;
        user()->profile->interest_rate_type             = $request->interest_rate_type;
        user()->profile->collateralized_loan            = $request->collateralized_loan;
        user()->profile->save();
        //$request->persistWithProgress();

        return redirect()->route('user-profile.final-page');
    }

    public function profileFinalPageShow()
    {
        $totalSteps  = 5;
        $currentStep = 5;

        $yes_no = [
            'yes' => 'Yes',
            'no'  => 'No',
        ];

        $creditScores        = UserProfile::CREDIT_SCORES;
        $visas               = Visa::all()->pluck('name', 'id');

        return view('user_profile.international_refinance.final',
            compact('currentStep','totalSteps', 'yes_no', 'creditScores', 'visas'));
    }

    public function profileFinalPage(Request $request)
    {
        $request->validate([
            'have_ssn'     => 'required',
            'credit_score' => 'required',
            'visa_id'      => 'required',
        ]);

        $user                  = user();
        $profile               = $user->profile;
        $profile->have_ssn     = $request->have_ssn;
        $profile->credit_score = $request->credit_score;
        $profile->visa_id      = $request->visa_id;
        $profile->save();
        //$request->persistWithProgress();

        $academicYear = AcademicYear::whereName(AcademicYear::ACADEMIC_YEAR_REFINANCE)->first();
        $profile->saveProgress(UserProfile::SIGNUP_PROGRESS_COMPLETED);
        $profile->placeInEligibleNegotiationGroups($academicYear);
        event(new UserPlacedInNegotiationGroup(user()));

        $user                           = user();
        $mostRecentNegotiationGroupUser = NegotiationGroupUser::where('user_id',$user->id)->orderBy('id','desc')->first();

        $names      = explode(' ', $user->name);
        $firstName  = implode(' ', array_slice($names, 0, -1));
        $mostRecentNegotiationGroupUser->negotiationGroup->load('endScreen.infoCardElements');

        $backLink = route('user-profile.final-page');

        $mailchimpAutomatedCampaignUser                                  = new MailchimpAutomatedCampaignUser();
        $mailchimpAutomatedCampaignUser->user_id                         = user()->id;
        $mailchimpAutomatedCampaignUser->mailchimp_automated_campaign_id = 44; //International Refinance Automated Campaign
        $mailchimpAutomatedCampaignUser->send_date                       = Carbon::today();
        $mailchimpAutomatedCampaignUser->status                          = MailchimpAutomatedCampaignUser::STATUS_PENDING_VALIDATION;
        $mailchimpAutomatedCampaignUser->save();

        if (!$mailchimpAutomatedCampaignUser->mailchimpAutomatedCampaign->should_be_validated) {
            $mailchimpAutomatedCampaignUser->send();
        }


        return view('user_profile.end', [
            'first_name'       => $firstName,
            'backLink'         => $backLink,
            'negotiationGroup' => $mostRecentNegotiationGroupUser->negotiationGroup,
        ]);

        //return redirect()->route('user-profile.final-page');
    }

    public function postAuth ()
    {
        return view('user_profile.international_refinance.post_auth');
    }
}
