<?php

namespace App\Http\Controllers;

use App\AcademicYear;
use App\AutoRefinanceApplication;
use App\CarMake;
use App\CarModel;
use App\CarYear;
use App\Events\EmailEnteredOnAutoRefinanceApplication;
use App\Events\UserPlacedInNegotiationGroup;
use App\Experiment;
use App\ExperimentType;
use App\FaqGroup;
use App\MailchimpAutomatedCampaignUser;
use App\NegotiationGroupUser;
use App\Repositories\Contracts\AutoRefinanceApplicationRepositoryInterface;
use App\Services\Experiments;
use App\Traits\ManagesExperimentParticipation;
use App\Traits\registersBorrowers;
use App\User;
use App\UserProfile;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AutoRefinanceController extends Controller
{
    use RegistersUsers, registersBorrowers, ManagesExperimentParticipation;

    protected $redirectTo = '/member/dashboard';

    protected $autoRefinanceApplicationRepo;

    protected $experiments;

    public function __construct(AutoRefinanceApplicationRepositoryInterface $autoRefinanceApplicationRepo, Experiments $experiments)
    {
        $this->autoRefinanceApplicationRepo = $autoRefinanceApplicationRepo;
        $this->experiments                  = $experiments;
    }

    public function autoRefinancePostAuth()
    {
        $experiment = $this->getOrAssignExperimentOfType(ExperimentType::AUTO_REFINANCE_POST_AUTH);

        switch ($experiment->id) {
            case Experiment::AUTO_REFI_POST_AUTH_LEADERBOARD:
                return redirect('/loans/auto-refinance/post-auth/v2');

            case Experiment::AUTO_REFI_POST_AUTH_VISUALIZED:
                return redirect('/loans/auto-refinance/post-auth/v3');
        }

        $faqs                     = FaqGroup::find(FaqGroup::AUTO_LOAN_REFINANCE)->questions;
        $completed_applications   = AutoRefinanceApplication::whereCompletedApplication(true)->count()+351;
        $progress                 = ($completed_applications *100)/1000;
        $no_completed_application = !optional(optional(user())->autoRefinanceApplications())->whereCompletedApplication(true)->exists();

        return view('landing-pages.post-auth.auto-refinance')->with(compact(
            'faqs','completed_applications', 'progress', 'no_completed_application'
        ));
    }

    public function autoRefinancePostAuthLeaderboard()
    {
        $this->getOrAssignExperimentOfType(ExperimentType::AUTO_REFINANCE_POST_AUTH);

        $faqs                     = FaqGroup::find(FaqGroup::AUTO_LOAN_REFINANCE)->questions;
        $completed_applications   = AutoRefinanceApplication::whereCompletedApplication(true)->count()+351;
        $progress                 = ($completed_applications *100)/1000;
        $no_completed_application = !optional(optional(user())->autoRefinanceApplications())->whereCompletedApplication(true)->exists();
        $shareImage               = 'leaderboard';

        return view('landing-pages.post-auth.auto-refinance')->with(compact(
            'faqs','completed_applications', 'progress', 'no_completed_application', 'shareImage'
        ));
    }

    public function autoRefinancePostAuthVisualized()
    {
        $this->getOrAssignExperimentOfType(ExperimentType::AUTO_REFINANCE_POST_AUTH);

        $faqs                     = FaqGroup::find(FaqGroup::AUTO_LOAN_REFINANCE)->questions;
        $completed_applications   = AutoRefinanceApplication::whereCompletedApplication(true)->count()+351;
        $progress                 = ($completed_applications *100)/1000;
        $no_completed_application = !optional(optional(user())->autoRefinanceApplications())->whereCompletedApplication(true)->exists();
        $shareImage               = 'visualized';

        return view('landing-pages.post-auth.auto-refinance')->with(compact(
            'faqs','completed_applications', 'progress', 'no_completed_application', 'shareImage'
        ));
    }

    public function getRedirectUrl(Request $request)
    {
        return redirect('/register');
    }

    private function getAutoLoansDetails()
    {
        $total_applications       = 1000;
        $completed_applications   = AutoRefinanceApplication::whereCompletedApplication(true)->count()+351;
        $payoff_amount            = AutoRefinanceApplication::whereCompletedApplication(true)->sum('payoff_amount');
        $additional_payoff_amount = AutoRefinanceApplication::whereCompletedApplication(true)->where(
                                        function($query) {
                                            $query->wherePayoffAmount(0)
                                                ->orWhereNull('payoff_amount');
                                        })->count()                                                                      *19500;
        $random_amount            = 351                                                                                  *19500;
        $refinance_amount         = number_format($payoff_amount + $additional_payoff_amount + $random_amount);
        $progress                 = ($completed_applications / $total_applications) * 100;

        return compact('total_applications','completed_applications', 'refinance_amount',
            'progress');
    }

    /**
     * @param Experiments $experiments
     * @return RedirectResponse|View
     */
    public function index(Experiments $experiments)
    {
        $redirectUrl = $experiments
            ->getOrAssignExperimentOfTypes([
                ExperimentType::AUTO_REFINANCE_LANDING_PAGE,
                ExperimentType::AUTO_REFINANCE_SIGN_UP,
            ])
            ->setAutoRefiRedirectUrls()
            ->getRedirectUrl();
        if ($redirectUrl) {
            return redirect()->to($redirectUrl);
        }

        return view('landing-pages.auto-refinance.auto-refinance', $this->autoRefinanceApplicationRepo->basicDetails());
    }

    public function indexv2()
    {
        if ($this->experiments->isPartOfExperiment(Experiment::AUTO_REFINANCE_LANDING_PAGE_V2)) {
            return view('landing-pages.auto-refinance.auto-refinance-v2', $this->autoRefinanceApplicationRepo->basicDetails());
        }

        return redirect()->route('auto-refinance.index');
    }

    public function indexv3()
    {
        if ($this->experiments->isPartOfExperiment(Experiment::AUTO_REFINANCE_LANDING_PAGE_V3)) {
            return view('landing-pages.auto-refinance.auto-refinance-v3', $this->autoRefinanceApplicationRepo->basicDetails());
        }

        return redirect()->route('auto-refinance.index');
    }

    public function indexv4()
    {
        if ($this->experiments->isPartOfExperiment(Experiment::AUTO_REFINANCE_LANDING_PAGE_V4)) {
            return view('landing-pages.auto-refinance.auto-refinance-v4', $this->autoRefinanceApplicationRepo->basicDetails());
        }

        return redirect()->route('auto-refinance.index');
    }

    public function indexv5()
    {
        if ($this->experiments->isPartOfExperiment(Experiment::AUTO_REFINANCE_LANDING_PAGE_V5)) {
            return view('landing-pages.auto-refinance.auto-refinance-v5', $this->autoRefinanceApplicationRepo->basicDetails());
        }

        return redirect()->route('auto-refinance.index');
    }

    public function indexv6()
    {
        if ($this->experiments->isPartOfExperiment(Experiment::AUTO_REFINANCE_LANDING_PAGE_V6)) {
            return view('landing-pages.auto-refinance.auto-refinance-v6', $this->autoRefinanceApplicationRepo->basicDetails());
        }

        return redirect()->route('auto-refinance.index');
    }

    public function indexv7()
    {
        if ($this->experiments->isPartOfExperiment(Experiment::AUTO_REFINANCE_LANDING_PAGE_V7)) {
            return view('landing-pages.auto-refinance.auto-refinance-v7', $this->autoRefinanceApplicationRepo->basicDetails());
        }

        return redirect()->route('auto-refinance.index');
    }

    public function indexv8()
    {
        if ($this->experiments->isPartOfExperiment(Experiment::AUTO_REFINANCE_LANDING_PAGE_V8)) {
            return view('landing-pages.auto-refinance.auto-refinance-v8', $this->autoRefinanceApplicationRepo->basicDetails());
        }

        return redirect()->route('auto-refinance.index');
    }

    public function indexv9()
    {
        if ($this->experiments->isPartOfExperiment(Experiment::AUTO_REFINANCE_LANDING_PAGE_V9)) {
            return view('landing-pages.auto-refinance.auto-refinance-v9', $this->autoRefinanceApplicationRepo->basicDetails());
        }

        return redirect()->route('auto-refinance.index');
    }

    public function start()
    {
        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_V7))) {
            return redirect('/loans/auto-refinance/get-started/v7/personal_info');
        }

        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_V6))) {
            return redirect('/loans/auto-refinance/get-started/v6/personal_info');
        }

        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_EXTREME_MINIMUM_QUESTIONS))) {
            return redirect('/loans/auto-refinance/get-started/v5/personal_info');
        }

        $autoRefinanceApplication = AutoRefinanceApplication::firstOrCreate(['client_id' => getClientId()]);
        $states                   = [
            'Alabama'              => 'Alabama',
            'Alaska'               => 'Alaska',
            'Arizona'              => 'Arizona',
            'Arkansas'             => 'Arkansas',
            'California'           => 'California',
            'Colorado'             => 'Colorado',
            'Connecticut'          => 'Connecticut',
            'Delaware'             => 'Delaware',
            'District of Columbia' => 'District of Columbia',
            'Florida'              => 'Florida',
            'Georgia'              => 'Georgia',
            'Hawaii'               => 'Hawaii',
            'Idaho'                => 'Idaho',
            'Illinois'             => 'Illinois',
            'Indiana'              => 'Indiana',
            'Iowa'                 => 'Iowa',
            'Kansas'               => 'Kansas',
            'Kentucky'             => 'Kentucky',
            'Louisiana'            => 'Louisiana',
            'Maine'                => 'Maine',
            'Maryland'             => 'Maryland',
            'Massachusetts'        => 'Massachusetts',
            'Michigan'             => 'Michigan',
            'Minnesota'            => 'Minnesota',
            'Mississippi'          => 'Mississippi',
            'Missouri'             => 'Missouri',
            'Montana'              => 'Montana',
            'Nebraska'             => 'Nebraska',
            'Nevada'               => 'Nevada',
            'New Hampshire'        => 'New Hampshire',
            'New Jersey'           => 'New Jersey',
            'New Mexico'           => 'New Mexico',
            'New York'             => 'New York',
            'North Carolina'       => 'North Carolina',
            'North Dakota'         => 'North Dakota',
            'Ohio'                 => 'Ohio',
            'Oklahoma'             => 'Oklahoma',
            'Oregon'               => 'Oregon',
            'Pennsylvania'         => 'Pennsylvania',
            'Rhode Island'         => 'Rhode Island',
            'South Carolina'       => 'South Carolina',
            'South Dakota'         => 'South Dakota',
            'Tennessee'            => 'Tennessee',
            'Texas'                => 'Texas',
            'Utah'                 => 'Utah',
            'Vermont'              => 'Vermont',
            'Virginia'             => 'Virginia',
            'Washington'           => 'Washington',
            'West Virginia'        => 'West Virginia',
            'Wisconsin'            => 'Wisconsin',
            'Wyoming'              => 'Wyoming',
        ];
        $years          = CarYear::orderByDesc('year')->pluck('year');
        $makes          = CarMake::orderBy('make')->pluck('make');
        $models         = CarModel::orderBy('model')->pluck('model');
        $carInformation = CarYear::with('carYearCarMakes.carMake.carMakeCarModels.carModel')
            ->whereHas('carYearCarMakes')
            ->orderBy('year','desc')
            ->get();

        $currentStep = 0;
        $totalSteps  = 0;
        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_CONTROL))) {
            $currentStep = 1;
            $totalSteps  = 6;
        }
        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_GET_LAST_4_SSN))) {
            $currentStep = 1;
            $totalSteps  = 7;
        }
        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_MINIMUM_QUESTIONS))) {
            $currentStep = 1;
            $totalSteps  = 5;
        }

        return view('auto-refinance.vehicle_details', compact(
            'autoRefinanceApplication',
            'states',
            'years',
            'makes',
            'models',
            'carInformation',
            'currentStep',
            'totalSteps'
        ));
    }

    public function vehicleInfo()
    {
        $autoRefinanceApplication = AutoRefinanceApplication::firstOrCreate(['client_id' => getClientId()]);

        return view('auto-refinance.vehicle_details', compact('autoRefinanceApplication'));
    }

    public function saveVehicleInfoByVin(Request $request)
    {
        $request->validate([
            'vin'                 => ['required'],
        ]);

        $request->flash();
        $autoRefinanceApplication                      = AutoRefinanceApplication::firstOrCreate(['client_id' => getClientId()]);
        $autoRefinanceApplication->vin                 = $request->vin;

        // A Client ID is already associated with an experiment so not sure what's the value of this, but we can keep it for now
        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_CONTROL))) {
            $autoRefinanceApplication->experiment_id        = Experiment::AUTO_REFINANCE_SIGN_UP_CONTROL;
        } elseif (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_SKIP_PASSWORD))) {
            $autoRefinanceApplication->experiment_id        = Experiment::AUTO_REFINANCE_SIGN_UP_SKIP_PASSWORD;
        } elseif (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_GET_LAST_4_SSN))) {
            $autoRefinanceApplication->experiment_id        = Experiment::AUTO_REFINANCE_SIGN_UP_GET_LAST_4_SSN;
        } elseif (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_MINIMUM_QUESTIONS))) {
            $autoRefinanceApplication->experiment_id        = Experiment::AUTO_REFINANCE_SIGN_UP_MINIMUM_QUESTIONS;
        }
        $autoRefinanceApplication->save();


        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_CONTROL))) {
            return redirect('/loans/auto-refinance/get-started/v1/payment_info');
        }

        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_SKIP_PASSWORD))) {
            return redirect('/loans/auto-refinance/get-started/v2/payment_info');
        }

        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_GET_LAST_4_SSN))) {
            return redirect('/loans/auto-refinance/get-started/v3/payment_info');
        }

        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_MINIMUM_QUESTIONS))) {
            return redirect('/loans/auto-refinance/get-started/v4/personal_info');
        }
    }

    public function saveVehicleInfoByPlate(Request $request)
    {
        $request->validate([
            'license_plate'       => ['required'],
            'license_plate_state' => ['required'],
        ]);

        $request->flash();
        $autoRefinanceApplication                      = AutoRefinanceApplication::firstOrCreate(['client_id' => getClientId()]);
        $autoRefinanceApplication->license_plate       = $request->license_plate;
        $autoRefinanceApplication->license_plate_state = $request->license_plate_state;

        // A Client ID is already associated with an experiment so not sure what's the value of this, but we can keep it for now
        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_CONTROL))) {
            $autoRefinanceApplication->experiment_id        = Experiment::AUTO_REFINANCE_SIGN_UP_CONTROL;
        } elseif (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_SKIP_PASSWORD))) {
            $autoRefinanceApplication->experiment_id        = Experiment::AUTO_REFINANCE_SIGN_UP_SKIP_PASSWORD;
        } elseif (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_GET_LAST_4_SSN))) {
            $autoRefinanceApplication->experiment_id        = Experiment::AUTO_REFINANCE_SIGN_UP_GET_LAST_4_SSN;
        } elseif (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_MINIMUM_QUESTIONS))) {
            $autoRefinanceApplication->experiment_id        = Experiment::AUTO_REFINANCE_SIGN_UP_MINIMUM_QUESTIONS;
        }
        $autoRefinanceApplication->save();

        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_CONTROL))) {
            return redirect('/loans/auto-refinance/get-started/v1/payment_info');
        }

        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_SKIP_PASSWORD))) {
            return redirect('/loans/auto-refinance/get-started/v2/payment_info');
        }

        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_GET_LAST_4_SSN))) {
            return redirect('/loans/auto-refinance/get-started/v3/payment_info');
        }

        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_MINIMUM_QUESTIONS))) {
            return redirect('/loans/auto-refinance/get-started/v4/personal_info');
        }
    }

    public function saveVehicleInfoByYearMakeModel(Request $request)
    {
        $request->validate([
            'vehicle_model'       => ['required'],
            'vehicle_make'        => ['required'],
            'vehicle_year'        => ['required'],
        ]);

        $request->flash();
        $autoRefinanceApplication                      = AutoRefinanceApplication::firstOrCreate(['client_id' => getClientId()]);
        $autoRefinanceApplication->vehicle_model       = $request->vehicle_model;
        $autoRefinanceApplication->vehicle_make        = $request->vehicle_make;
        $autoRefinanceApplication->vehicle_year        = $request->vehicle_year;

        // A Client ID is already associated with an experiment so not sure what's the value of this, but we can keep it for now
        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_CONTROL))) {
            $autoRefinanceApplication->experiment_id        = Experiment::AUTO_REFINANCE_SIGN_UP_CONTROL;
        } elseif (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_SKIP_PASSWORD))) {
            $autoRefinanceApplication->experiment_id        = Experiment::AUTO_REFINANCE_SIGN_UP_SKIP_PASSWORD;
        } elseif (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_GET_LAST_4_SSN))) {
            $autoRefinanceApplication->experiment_id        = Experiment::AUTO_REFINANCE_SIGN_UP_GET_LAST_4_SSN;
        } elseif (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_MINIMUM_QUESTIONS))) {
            $autoRefinanceApplication->experiment_id        = Experiment::AUTO_REFINANCE_SIGN_UP_MINIMUM_QUESTIONS;
        }
        $autoRefinanceApplication->save();

        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_CONTROL))) {
            return redirect('/loans/auto-refinance/get-started/v1/payment_info');
        }

        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_SKIP_PASSWORD))) {
            return redirect('/loans/auto-refinance/get-started/v2/payment_info');
        }

        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_GET_LAST_4_SSN))) {
            return redirect('/loans/auto-refinance/get-started/v3/payment_info');
        }

        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_MINIMUM_QUESTIONS))) {
            return redirect('/loans/auto-refinance/get-started/v4/personal_info');
        }
    }

    public function saveVehicleInfo(Request $request)
    {
        if ($request->has('vin')) {
            return $this->saveVehicleInfoByVin($request);
        }

        if ($request->has('license_plate') && $request->has('license_plate_state')) {
            return $this->saveVehicleInfoByPlate($request);
        }

        if ($request->has('vehicle_model') && $request->has('vehicle_make') && $request->has('vehicle_year')) {
            return $this->saveVehicleInfoByYearMakeModel($request);
        }
    }

    public function savePaymentInfo(Request $request)
    {
        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_V7))) {
            $request->validate([
                'payoff_amount'   => 'required|numeric',
                'credit_score'    => 'required',
            ]);

            $autoRefinanceApplication                      = AutoRefinanceApplication::firstOrCreate(['client_id' => getClientId()]);
            $autoRefinanceApplication->payoff_amount       = $request->payoff_amount;
            $autoRefinanceApplication->credit_score        = $request->credit_score;
            $autoRefinanceApplication->save();

            return redirect('/loans/auto-refinance/get-started/v7/password');
        }

        $request->validate([
            'payoff_amount'   => ['nullable', 'numeric'],
            'monthly_payment' => ['nullable', 'numeric'],
            'mileage'         => ['required', 'numeric'],
        ]);
        $autoRefinanceApplication                      = AutoRefinanceApplication::firstOrCreate(['client_id' => getClientId()]);
        $autoRefinanceApplication->payoff_amount       = $request->payoff_amount;
        $autoRefinanceApplication->monthly_payment     = $request->monthly_payment;
        $autoRefinanceApplication->mileage             = $request->mileage;
        $autoRefinanceApplication->credit_score        = $request->credit_score;
        $autoRefinanceApplication->save();

        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_CONTROL))) {
            return redirect('/loans/auto-refinance/get-started/v1/personal_info');
        }

        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_SKIP_PASSWORD))) {
            return redirect('/loans/auto-refinance/get-started/v2/personal_info');
        }

        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_GET_LAST_4_SSN))) {
            return redirect('/loans/auto-refinance/get-started/v3/personal_info');
        }

        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_MINIMUM_QUESTIONS))) {
            return redirect('/loans/auto-refinance/get-started/v4/employment_info');
        }
    }

    public function savePersonalInfo(Request $request)
    {
        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_V6))) {
            $request->validate([
                'first_name'    => 'required',
                'last_name'     => 'required',
                'email'         => 'required|string|email|max:255',
                'payoff_amount' => 'required',
                'credit_score'  => 'required',

            ]);

            $autoRefinanceApplication                      = AutoRefinanceApplication::firstOrCreate(['client_id' => getClientId()]);
            $autoRefinanceApplication->first_name          = $request->first_name;
            $autoRefinanceApplication->last_name           = $request->last_name;
            $autoRefinanceApplication->email               = $request->email;
            $autoRefinanceApplication->payoff_amount       = $request->payoff_amount;
            $autoRefinanceApplication->credit_score        = $request->credit_score;
            $autoRefinanceApplication->save();

            $requestInformation = [
                'ip_address'       => $request->ip(),
                'user_agent'       => $request->userAgent(),
                'path'             => $request->path(),
                'url'              => $request->fullUrl(),
                'fbp'              => Cookie::has('_fbp') ? Cookie::get('_fbp') : null,
                'fbc'              => null,
                'google_client_id' => Cookie::has('_ga') ? substr(Cookie::get('_ga'),6) : null,
            ];

            $eventInformation = [
                'category'  => 'auto-refinance',
                'action'    => 'ViewContent',
                'label'     => 'auto-refinance',
                'value'     => 0,
            ];

            event(new EmailEnteredOnAutoRefinanceApplication($requestInformation, $eventInformation, $request->email));

            return redirect('/loans/auto-refinance/get-started/v6/password');
        }

        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_V7))) {
            $request->validate([
                'first_name'    => 'required',
                'last_name'     => 'required',
                'email'         => 'required|string|email|max:255',
            ]);

            $autoRefinanceApplication                      = AutoRefinanceApplication::firstOrCreate(['client_id' => getClientId()]);
            $autoRefinanceApplication->first_name          = $request->first_name;
            $autoRefinanceApplication->last_name           = $request->last_name;
            $autoRefinanceApplication->email               = $request->email;
            $autoRefinanceApplication->save();

            $requestInformation = [
                'ip_address'       => $request->ip(),
                'user_agent'       => $request->userAgent(),
                'path'             => $request->path(),
                'url'              => $request->fullUrl(),
                'fbp'              => Cookie::has('_fbp') ? Cookie::get('_fbp') : null,
                'fbc'              => null,
                'google_client_id' => Cookie::has('_ga') ? substr(Cookie::get('_ga'),6) : null,
            ];

            $eventInformation = [
                'category'  => 'auto-refinance',
                'action'    => 'ViewContent',
                'label'     => 'auto-refinance',
                'value'     => 0,
            ];

            event(new EmailEnteredOnAutoRefinanceApplication($requestInformation, $eventInformation, $request->email));

            return redirect('/loans/auto-refinance/get-started/v7/payment_info');
        }

        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_EXTREME_MINIMUM_QUESTIONS))) {
            $request->validate([
                'first_name'    => 'required',
                'last_name'     => 'required',
                'email'         => 'required|string|email|max:255',
            ]);

            $autoRefinanceApplication                      = AutoRefinanceApplication::firstOrCreate(['client_id' => getClientId()]);
            $autoRefinanceApplication->first_name          = $request->first_name;
            $autoRefinanceApplication->last_name           = $request->last_name;
            $autoRefinanceApplication->email               = $request->email;
            $autoRefinanceApplication->save();

            $requestInformation = [
                'ip_address'       => $request->ip(),
                'user_agent'       => $request->userAgent(),
                'path'             => $request->path(),
                'url'              => $request->fullUrl(),
                'fbp'              => Cookie::has('_fbp') ? Cookie::get('_fbp') : null,
                'fbc'              => null,
                'google_client_id' => Cookie::has('_ga') ? substr(Cookie::get('_ga'),6) : null,
            ];

            $eventInformation = [
                'category'  => 'auto-refinance',
                'action'    => 'ViewContent',
                'label'     => 'auto-refinance',
                'value'     => 0,
            ];

            event(new EmailEnteredOnAutoRefinanceApplication($requestInformation, $eventInformation, $request->email));

            return redirect('/loans/auto-refinance/get-started/v5/password');
        }

        $request->validate([
            'first_name'    => 'required',
            'last_name'     => 'required',
            'email'         => 'required|string|email|max:255',
        ]);
        $autoRefinanceApplication                      = AutoRefinanceApplication::firstOrCreate(['client_id' => getClientId()]);
        $autoRefinanceApplication->first_name          = $request->first_name;
        $autoRefinanceApplication->last_name           = $request->last_name;
        $autoRefinanceApplication->date_of_birth       = $request->date_of_birth;
        $autoRefinanceApplication->email               = $request->email;
        $autoRefinanceApplication->save();

        $requestInformation = [
            'ip_address'       => $request->ip(),
            'user_agent'       => $request->userAgent(),
            'path'             => $request->path(),
            'url'              => $request->fullUrl(),
            'fbp'              => Cookie::has('_fbp') ? Cookie::get('_fbp') : null,
            'fbc'              => null,
            'google_client_id' => Cookie::has('_ga') ? substr(Cookie::get('_ga'),6) : null,
        ];

        $eventInformation = [
            'category'  => 'auto-refinance',
            'action'    => 'ViewContent',
            'label'     => 'auto-refinance',
            'value'     => 0,
        ];

        event(new EmailEnteredOnAutoRefinanceApplication($requestInformation, $eventInformation, $request->email));

        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_CONTROL))) {
            return redirect('/loans/auto-refinance/get-started/v1/housing_info');
        }

        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_SKIP_PASSWORD))) {
            return redirect('/loans/auto-refinance/get-started/v2/housing_info');
        }

        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_GET_LAST_4_SSN))) {
            return redirect('/loans/auto-refinance/get-started/v3/housing_info');
        }

        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_MINIMUM_QUESTIONS))) {
            return redirect('/loans/auto-refinance/get-started/v4/payment_info');
        }
    }

    public function saveHousingInfo(Request $request)
    {
        $request->validate([
            'street_address'      => 'required',
            'city'                => 'required',
            'state'               => 'required',
            'zip_code'            => 'required|numeric|digits:5',
            'residence_ownership' => 'required',
            'stay_duration'       => 'required',
            'housing_payment'     => 'required',
        ]);
        $autoRefinanceApplication                          = AutoRefinanceApplication::firstOrCreate(['client_id' => getClientId()]);
        $autoRefinanceApplication->street_address          = $request->street_address;
        $autoRefinanceApplication->street_address_2        = $request->street_address_2;
        $autoRefinanceApplication->city                    = $request->city;
        $autoRefinanceApplication->state                   = $request->state;
        $autoRefinanceApplication->zip_code                = $request->zip_code;
        $autoRefinanceApplication->residence_ownership     = $request->residence_ownership;
        $autoRefinanceApplication->stay_duration           = $request->stay_duration;
        $autoRefinanceApplication->housing_payment         = $request->housing_payment;
        $autoRefinanceApplication->save();

        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_CONTROL))) {
            return redirect('/loans/auto-refinance/get-started/v1/employment_info');
        }

        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_SKIP_PASSWORD))) {
            return redirect('/loans/auto-refinance/get-started/v2/employment_info');
        }

        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_GET_LAST_4_SSN))) {
            return redirect('/loans/auto-refinance/get-started/v3/employment_info');
        }
    }

    public function saveEmploymentInfo(Request $request)
    {
        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_MINIMUM_QUESTIONS))) {
            $request->validate([
                'zip_code'              => 'required',
                'yearly_pre_tax_income' => 'required',
                'credit_score'          => [
                    'required',
                    Rule::in(UserProfile::CREDIT_SCORES),
                ],
            ]);
        } else {
            $request->validate([
                'employment_status'     => 'required',
                'yearly_pre_tax_income' => 'required',
                'work_duration'         => 'required',
                'credit_score'          => [
                    'required',
                    Rule::in(UserProfile::CREDIT_SCORES),
                ],
            ]);
        }

        $autoRefinanceApplication                          = AutoRefinanceApplication::firstOrCreate(['client_id' => getClientId()]);
        $autoRefinanceApplication->employment_status       = $request->employment_status;
        $autoRefinanceApplication->yearly_pre_tax_income   = $request->yearly_pre_tax_income;
        $autoRefinanceApplication->work_duration           = $request->work_duration;
        $autoRefinanceApplication->save();

        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_CONTROL))) {
            if (auth()->check()) {
                $this->completeApplication($autoRefinanceApplication);

                return redirect()->route('auto_refinance_end_screen');
            }

            return redirect('/loans/auto-refinance/get-started/v1/password');
        }

        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_SKIP_PASSWORD))) {
            if (auth()->check()) {
                $this->completeApplication($autoRefinanceApplication);

                return redirect()->route('auto_refinance_end_screen');
            }

            $request->request->add([
                'email'    => $autoRefinanceApplication->email,
                'password' => Str::random(20),
            ]);

            return $this->register($request);
        }

        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_GET_LAST_4_SSN))) {
            return redirect('/loans/auto-refinance/get-started/v3/ssn');
        }

        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_MINIMUM_QUESTIONS))) {
            if (auth()->check()) {
                $this->completeApplication($autoRefinanceApplication);

                return redirect()->route('auto_refinance_end_screen');
            }

            return redirect('/loans/auto-refinance/get-started/v4/password');
        }
    }

    public function savePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6',
        ]);

        $autoRefinanceApplication               = AutoRefinanceApplication::firstOrCreate(['client_id' => getClientId()]);
        $user                                   = User::whereEmail($autoRefinanceApplication->email)->first();
        $request->request->add(['email' => $autoRefinanceApplication->email]);
        $credentials = $request->only('email', 'password');

        if (!empty($user)) {
            if (Auth::attempt($credentials)) {
                $this->completeApplication($autoRefinanceApplication);

                return redirect()->route('auto_refinance_end_screen');
            }

            throw ValidationException::withMessages(['password' => 'This password does not match the  existing email/password account information.']);
        }

        return $this->register($request);
    }

    public function saveSsn(Request $request)
    {
        $request->validate([
            'ssn' => 'required|string|min:4|max:4',
        ]);

        $autoRefinanceApplication            = AutoRefinanceApplication::firstOrCreate(['client_id' => getClientId()]);
//        $autoRefinanceApplication->ssn       = $request->ssn;
        $autoRefinanceApplication->save();

        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_GET_LAST_4_SSN))) {
            if (auth()->check()) {
                $this->completeApplication($autoRefinanceApplication);

                return redirect()->route('auto_refinance_end_screen');
            }

            return redirect('/loans/auto-refinance/get-started/v3/password');
        }
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $autoRefinanceApplication = AutoRefinanceApplication::firstOrCreate(['client_id' => getClientId()]);
        $user                     = $this->create($request->all());

        $this->createBorrowerProfile($user);

        $user->save();
        Auth::loginUsingId($user->id);

        $this->completeApplication($autoRefinanceApplication);

        return redirect()->route('auto_refinance_end_screen');
    }

    protected function registered(Request $request, $user)
    {
        //event(new Registered($user));

        $this->guard()->login($user);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
    }

    public function paymentInfo($experimentId)
    {
        $currentStep = 0;
        $totalSteps  = 0;

        $autoRefinanceApplication = AutoRefinanceApplication::firstOrCreate(['client_id' => getClientId()]);
        $creditScores             = UserProfile::CREDIT_SCORES;

        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_CONTROL))) {
            $currentStep = 2;
            $totalSteps  = 6;
        }
        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_GET_LAST_4_SSN))) {
            $currentStep = 2;
            $totalSteps  = 7;
        }
        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_MINIMUM_QUESTIONS))) {
            $currentStep = 3;
            $totalSteps  = 5;
        }

        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_V7))) {
            $currentStep = 2;
            $totalSteps  = 3;

            return view('auto-refinance.payoff_score', compact(
                'autoRefinanceApplication',
                'currentStep',
                'totalSteps'
            ));
        }

        return view('auto-refinance.payment_info', compact(
            'autoRefinanceApplication',
            'creditScores',
            'currentStep',
            'totalSteps'
        ));
    }

    public function personalInfo($experimentId)
    {
        $currentStep              = 0;
        $totalSteps               = 0;
        $autoRefinanceApplication = AutoRefinanceApplication::firstOrCreate(['client_id' => getClientId()]);

        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_V6))) {
            $currentStep = 1;
            $totalSteps  = 2;

            return view('auto-refinance.personal_info_with_score', compact('autoRefinanceApplication',
                'currentStep',
                'totalSteps'));
        }

        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_V7))) {
            $currentStep = 1;
            $totalSteps  = 3;

            return view('auto-refinance.personal_info_no_birthday', compact('autoRefinanceApplication',
                'currentStep',
                'totalSteps'));
        }

        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_CONTROL))) {
            $currentStep = 3;
            $totalSteps  = 6;
        }
        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_GET_LAST_4_SSN))) {
            $currentStep = 3;
            $totalSteps  = 7;
        }
        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_MINIMUM_QUESTIONS))) {
            $currentStep = 2;
            $totalSteps  = 5;

            return view('auto-refinance.personal_info_no_birthday', compact('autoRefinanceApplication',
                'currentStep',
                'totalSteps'));
        }

        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_EXTREME_MINIMUM_QUESTIONS))
        ) {
            $currentStep = 1;
            $totalSteps  = 2;

            return view('auto-refinance.personal_info_no_birthday', compact('autoRefinanceApplication',
                'currentStep',
                'totalSteps'));
        }

        return view('auto-refinance.personal_info', compact(
            'autoRefinanceApplication',
        'currentStep',
            'totalSteps'));
    }

    public function housingInfo($experimentId)
    {
        $currentStep = 0;
        $totalSteps  = 0;

        $autoRefinanceApplication = AutoRefinanceApplication::firstOrCreate(['client_id' => getClientId()]);
        $states                   = [
            'Alabama'              => 'Alabama',
            'Alaska'               => 'Alaska',
            'Arizona'              => 'Arizona',
            'Arkansas'             => 'Arkansas',
            'California'           => 'California',
            'Colorado'             => 'Colorado',
            'Connecticut'          => 'Connecticut',
            'Delaware'             => 'Delaware',
            'District of Columbia' => 'District of Columbia',
            'Florida'              => 'Florida',
            'Georgia'              => 'Georgia',
            'Hawaii'               => 'Hawaii',
            'Idaho'                => 'Idaho',
            'Illinois'             => 'Illinois',
            'Indiana'              => 'Indiana',
            'Iowa'                 => 'Iowa',
            'Kansas'               => 'Kansas',
            'Kentucky'             => 'Kentucky',
            'Louisiana'            => 'Louisiana',
            'Maine'                => 'Maine',
            'Maryland'             => 'Maryland',
            'Massachusetts'        => 'Massachusetts',
            'Michigan'             => 'Michigan',
            'Minnesota'            => 'Minnesota',
            'Mississippi'          => 'Mississippi',
            'Missouri'             => 'Missouri',
            'Montana'              => 'Montana',
            'Nebraska'             => 'Nebraska',
            'Nevada'               => 'Nevada',
            'New Hampshire'        => 'New Hampshire',
            'New Jersey'           => 'New Jersey',
            'New Mexico'           => 'New Mexico',
            'New York'             => 'New York',
            'North Carolina'       => 'North Carolina',
            'North Dakota'         => 'North Dakota',
            'Ohio'                 => 'Ohio',
            'Oklahoma'             => 'Oklahoma',
            'Oregon'               => 'Oregon',
            'Pennsylvania'         => 'Pennsylvania',
            'Rhode Island'         => 'Rhode Island',
            'South Carolina'       => 'South Carolina',
            'South Dakota'         => 'South Dakota',
            'Tennessee'            => 'Tennessee',
            'Texas'                => 'Texas',
            'Utah'                 => 'Utah',
            'Vermont'              => 'Vermont',
            'Virginia'             => 'Virginia',
            'Washington'           => 'Washington',
            'West Virginia'        => 'West Virginia',
            'Wisconsin'            => 'Wisconsin',
            'Wyoming'              => 'Wyoming',
        ];
        $years_at_address = [
            'Less than 1 year',
            '1+ years',
            '2+ years',
            '3+ years',
            '4+ years',
            '5+ years',
            '6+ years',
        ];

        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_CONTROL))) {
            $currentStep = 4;
            $totalSteps  = 6;
        }
        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_GET_LAST_4_SSN))) {
            $currentStep = 4;
            $totalSteps  = 7;
        }

        return view('auto-refinance.housing_info', compact(
            'autoRefinanceApplication',
            'states',
            'years_at_address',
            'currentStep',
            'totalSteps'
        ));
    }

    public function employmentInfo($experimentId)
    {
        $currentStep = 0;
        $totalSteps  = 0;

        $autoRefinanceApplication = AutoRefinanceApplication::firstOrCreate(['client_id' => getClientId()]);
        $yearsWorkedOptions       = [
            'Less than 1 year',
            '1+ years',
            '2+ years',
            '3+ years',
            '4+ years',
            '5+ years',
            '6+ years',
        ];
        $creditScores             = UserProfile::CREDIT_SCORES;

        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_CONTROL))) {
            $currentStep = 5;
            $totalSteps  = 6;
        }
        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_GET_LAST_4_SSN))) {
            $currentStep = 5;
            $totalSteps  = 7;
        }
        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_MINIMUM_QUESTIONS))) {
            $currentStep = 4;
            $totalSteps  = 5;
        }

        return view('auto-refinance.employment_info', compact(
            'autoRefinanceApplication',
            'yearsWorkedOptions',
            'creditScores',
            'currentStep',
            'totalSteps'
        ));
    }

    public function password($experimentId)
    {
        $currentStep = 0;
        $totalSteps  = 0;

        $autoRefinanceApplication = AutoRefinanceApplication::firstOrCreate(['client_id' => getClientId()]);

        if (Auth::check()) {
            $this->completeApplication($autoRefinanceApplication);

            return redirect()->route('auto_refinance_end_screen');
        }

        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_CONTROL))) {
            $currentStep = 6;
            $totalSteps  = 6;
        }
        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_GET_LAST_4_SSN))) {
            $currentStep = 7;
            $totalSteps  = 7;
        }
        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_MINIMUM_QUESTIONS))) {
            $currentStep = 5;
            $totalSteps  = 5;
        }

        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_EXTREME_MINIMUM_QUESTIONS)) ||
            getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_V6))) {
            $currentStep = 2;
            $totalSteps  = 2;
        }

        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_EXTREME_MINIMUM_QUESTIONS)) ||
            getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_V7))) {
            $currentStep = 3;
            $totalSteps  = 3;
        }

        return view('auto-refinance.password', compact(
            'autoRefinanceApplication',
            'currentStep',
            'totalSteps'
        ));
    }

    public function ssn($experimentId)
    {
        $currentStep = 0;
        $totalSteps  = 0;

        $autoRefinanceApplication = AutoRefinanceApplication::firstOrCreate(['client_id' => getClientId()]);

        if (getClient()->isPartOfExperiment(Experiment::find(Experiment::AUTO_REFINANCE_SIGN_UP_GET_LAST_4_SSN))) {
            $currentStep = 6;
            $totalSteps  = 7;
        }

        return view('auto-refinance.ssn_info', compact(
            'autoRefinanceApplication',
            'currentStep',
            'totalSteps'
        ));
    }

    public function done($experimentId)
    {
        $autoRefinanceApplication = AutoRefinanceApplication::firstOrCreate(['client_id' => getClientId()]);

        return view('auto-refinance.done', compact('autoRefinanceApplication'));
    }

    public function transferContentToUserProfile()
    {
        $user                           = user();
        $user->profile->loan_type       = UserProfile::LOAN_TYPE_AUTO_REFINANCE;
        $user->profile->signup_progress = self::SIGNUP_PROGRESS_COMPLETED;
    }

    public function completeApplication(AutoRefinanceApplication $autoRefinanceApplication)
    {
        $autoRefinanceApplication->completed_application = true;
        $autoRefinanceApplication->save();

        $profile                  = userProfile();
        $profile->signup_progress = UserProfile::SIGNUP_PROGRESS_COMPLETED;
        $profile->save();
        $user         = user();
        $academicYear = AcademicYear::find(AcademicYear::ACADEMIC_YEAR_AUTO_REFI_ID);
        $profile->placeInEligibleNegotiationGroups($academicYear);
        event(new UserPlacedInNegotiationGroup($user));

        $autoRefinanceApplication->user_id = $user->id;
        $autoRefinanceApplication->save();

        if (empty($user->first_name)) {
            $user->first_name = $autoRefinanceApplication->first_name;
        }

        if (empty($user->last_name)) {
            $user->last_name = $autoRefinanceApplication->last_name;
        }
        $user->save();

        $mailchimpAutomatedCampaignUser                                  = new MailchimpAutomatedCampaignUser();
        $mailchimpAutomatedCampaignUser->user_id                         = user()->id;
        $mailchimpAutomatedCampaignUser->mailchimp_automated_campaign_id = 42; //Auto Refi Mailchimp Automated Campaign
        $mailchimpAutomatedCampaignUser->send_date                       = Carbon::today();
        $mailchimpAutomatedCampaignUser->status                          = MailchimpAutomatedCampaignUser::STATUS_PENDING_VALIDATION;
        $mailchimpAutomatedCampaignUser->save();

        if (!$mailchimpAutomatedCampaignUser->mailchimpAutomatedCampaign->should_be_validated) {
            $mailchimpAutomatedCampaignUser->send();
        }
    }

    public function getEndScreen()
    {
        $user                           = user();
        $mostRecentNegotiationGroupUser = NegotiationGroupUser::where('user_id',$user->id)->orderBy('id','desc')->first();

        $names      = explode(' ', $user->name);
        $firstName  = implode(' ', array_slice($names, 0, -1));
        $mostRecentNegotiationGroupUser->negotiationGroup->load('endScreen.infoCardElements');

        return view('user_profile.end', [
            'first_name'       => $firstName,
            'negotiationGroup' => $mostRecentNegotiationGroupUser->negotiationGroup,
        ]);
    }
}
