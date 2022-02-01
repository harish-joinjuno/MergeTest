<?php

namespace App\Http\Controllers;

use App\AcademicYear;
use App\ActionNotifications\DisplayActionNotifications;
use App\Experiment;
use App\ExperimentType;
use App\FaqGroup;
use App\LandingPage;
use App\NegotiationGroup;
use App\Press;
use App\Rate;
use App\Services\Experiments;
use App\Traits\ManagesExperimentParticipation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

/*
 * WelcomeController is  used to display common public facing pages.
 * Typically, these pages are not customized for a user
 */
class WelcomeController extends Controller
{
    use ManagesExperimentParticipation;

    public function redirectToHome()
    {
        return redirect('/');
    }

    public function index()
    {
        DisplayActionNotifications::all();

        return view('landing-pages.home');
    }

    public function indexV2()
    {
        DisplayActionNotifications::all();

        return view('landing-pages.home-v2');
    }

    public function products()
    {
        return view('products');
    }

    public function ourStory()
    {
        return view('our-story');
    }

    public function contact()
    {
        return view('contact');
    }

    public function reviews()
    {
        return view('reviews');
    }

    public function press()
    {
        return view('press')->with('presses',Press::orderBy('date_published','DESC')->get());
    }

    public function ourTrackRecord()
    {
        return view('our-track-record');
    }

    public function howItWorks()
    {
        return view('how-it-works');
    }

    public function temporaryRedirectToHome()
    {
        return redirect('https://joinjuno.com',302);
    }

    public function showFall2020Campaign()
    {
        $negotiationGroup = NegotiationGroup::where('slug','general-group-20-21')->first();

        return view('fall-2020-campaign')
            ->with('negotiationGroup', $negotiationGroup);
    }

    public function showRefinanceCampaign()
    {
        return redirect('/loans/refinance');
    }

    public function showRefinanceCampaignForAda()
    {
        return redirect('/loans/refinance');
    }

    public function showFutureFall2020Campaign()
    {
        $negotiationGroup = NegotiationGroup::where('slug','general-group-20-21')->first();

        return view('future-fall-2020-campaign')
            ->with('negotiationGroup', $negotiationGroup);
    }

    public function covidNoDeadline()
    {
        return view('covid-no-deadline');
    }

    public function recommendations()
    {
        return view('recommendations');
    }

    public function templates()
    {
        return view('templates');
    }

    public function blogMatt()
    {
        return view('blog.matt');
    }

    public function aboutUs()
    {
        return view('about-us');
    }

    public function eligibility()
    {
        return view('eligibility');
    }

    public function fixedVsVariable()
    {
        return view('fixed-vs-variable');
    }

    public function undergraduate()
    {
        $faqs  = FaqGroup::find(FaqGroup::UNDERGRADUATE_PAGE)->questions;
        $rates = Rate::with('rateProperties')->find(Rate::UNDERGRADUATE_PAGE);

        return view('landing-pages.undergrad-v2', [
            'faqs'  => $faqs,
            'rates' => $rates,
        ]);
    }

    public function graduate()
    {
        $faqs     = FaqGroup::find(FaqGroup::GRADUATE_PAGE)->questions;
        $rates    = Rate::with('rateProperties')->find(Rate::GRADUATE_PAGE);

        return view('landing-pages.graduate-v2', [
           'faqs'  => $faqs,
           'rates' => $rates,
        ]);
    }

    public function parentUndergraduate()
    {
        $faqs = FaqGroup::find(FaqGroup::UNDERGRADUATE_PAGE)->questions;

        return view('parentUndergraduate')->with('faqs',$faqs);
    }

    public function refinance(Experiments $experiments)
    {
        $redirectUrl = $experiments->getOrAssignExperimentOfType(ExperimentType::SLR_LANDING_PAGE)
            ->setRefinanceRedirectUrls()
            ->getRedirectUrl();

        if ($redirectUrl) {
            return redirect()->to($redirectUrl);
        }

        $faqs     = FaqGroup::find(FaqGroup::REFI_LOAN_DETAIL_PAGE)->questions;
        $rates    = Rate::with('rateProperties')->find(Rate::REFI_LOAN_DETAIL_PAGE);

        return view('landing-pages.refinance', [
            'faqs'     => $faqs,
            'rates'    => $rates,
        ]);
    }

    public function refinanceV2()
    {
        return view('landing-pages.refinance-v2');
    }

    public function refinanceV3()
    {
        return view('landing-pages.refinance-v3');
    }

    public function refinanceV4()
    {
        return view('landing-pages.refinance-v4');
    }

    public function refinanceV5()
    {
        return view('landing-pages.refinance-v5');
    }

    public function refinanceV6()
    {
        return view('landing-pages.refinance-v6');
    }

    public function refinanceV7()
    {
        return view('landing-pages.refinance-v7');
    }

    public function refinanceV8()
    {
        return view('landing-pages.refinance-v8');
    }

    public function temple(Experiments $experiments)
    {
        $redirectUrl = $experiments
            ->getOrAssignExperimentOfType(ExperimentType::TEMPLE_LANDING_PAGE)
            ->setTempleRedirectUrls()
            ->getRedirectUrl();

        if ($redirectUrl) {
            return redirect()->to($redirectUrl);
        }

        return view('landing-pages.temple.undergrad');
    }

    public function templeV2(Experiments $experiments)
    {
        if ($experiments->isPartOfExperiment(Experiment::TEMPLE_V2)) {
            return view('landing-pages.temple.undergrad-v2');
        }

        return redirect('/loans/undergraduate/temple');
    }

    public function privateVsFederal()
    {
        return view('private-vs-federal');
    }

    public function accessibility()
    {
        return view('landing-pages.accessibility');
    }

    public function partnerships()
    {
        return view('landing-pages.partnerships-public');
    }

    public function getPartnerships(LandingPage $landingPage)
    {
        return view('landing-pages.partnerships.' . $landingPage->template->slug, $this->getPartnershipData($landingPage));
    }

    public function partnershipsMultiple($partner)
    {
        $partner  = $this->getPartnershipData($partner);

        return view('landing-pages.partnerships.partnerships-multiple-user', [
            'partner' => $partner,
        ]);
    }

    public function partnershipsRefinance($partner)
    {
        $faqs     = FaqGroup::find(FaqGroup::REFI_LOAN_DETAIL_PAGE)->questions;
        $rates    = Rate::with('rateProperties')->find(Rate::REFI_LOAN_DETAIL_PAGE);
        $partner  = $this->getPartnershipData($partner);

        return view('landing-pages.partnerships.partnerships-refinance', [
            'faqs'     => $faqs,
            'rates'    => $rates,
            'partner'  => $partner,
        ]);
    }

    public function partnershipsUndergrad($partner)
    {
        $faqs     = FaqGroup::find(FaqGroup::UNDERGRADUATE_PAGE)->questions;
        $rates    = Rate::with('rateProperties')->find(Rate::UNDERGRADUATE_PAGE);
        $partner  = $this->getPartnershipData($partner);

        return view('landing-pages.partnerships.partnerships-undergrad', [
            'faqs'     => $faqs,
            'rates'    => $rates,
            'partner'  => $partner,
        ]);
    }

    private function getPartnershipData(LandingPage $landingPage)
    {
        $defaultData = [
            'partner' => [
                'logo' => Storage::disk('s3_app_public')->url($landingPage->logo),
            ],
        ];

        $requiredProperties = $landingPage->template->required_properties;
        if ($requiredProperties) {
            foreach ($requiredProperties as $requiredProperty) {
                $defaultData['partner'][$requiredProperty] =  $landingPage->properties->$requiredProperty;
            }
        }

        $defaultData['rates']                  = $landingPage->template->rates->first();
        $defaultData['altRates']               = $landingPage->template->altRates->first();
        if ($landingPage->template->faqGroups->count()) {
            $defaultData['faqs']               = $landingPage->template->faqGroups->pluck('questions')->toArray()[0];
        }
        $defaultData['hideMedical']            = $landingPage->hide_medical;
        $defaultData['nonMedicalSectionTitle'] = $landingPage->non_medical_section_title;
        $defaultData['name']                   = $landingPage->partner_profile->user->name;

        return $defaultData;
    }

    public function academicYear2122()
    {
        $faqGroup               = FaqGroup::find(FaqGroup::AY_2021_22);
        $academicYear           = AcademicYear::find(AcademicYear::ACADEMIC_YEAR_FALL_21_AND_BEYOND_ID);
        $completed_applications = $academicYear->users_count;
        $total_applications     = 10000;
        $target_date            = Carbon::createFromDate(2021,03,15)->diffInDays();
        $faqs                   = $faqGroup ? $faqGroup->questions : null;

        return view('landing-pages.campaigns.ay-2021-22', [
            'faqs'                   => $faqs,
            'progress'               => floor($completed_applications/$total_applications*100),
            'completed_applications' => $completed_applications,
            'days_to_go'             => $target_date,
        ]);
    }

    public function internaltionalAcademicYear2122()
    {
        $faqGroup               = FaqGroup::find(FaqGroup::INTERNATIONAL_AY_2021_22);
        $negotiationGroup       = NegotiationGroup::find(NegotiationGroup::NG_INTERNATIONAL_GROUP_21_22);
        $completed_applications = $negotiationGroup->users_count;
        $total_applications     = 10000;
        $target_date            = Carbon::createFromDate(2021,03,15)->diffInDays();
        $faqs                   = $faqGroup ? $faqGroup->questions : null;

        return view('landing-pages.campaigns.international-ay-2021-22', [
            'faqs'                   => $faqs,
            'progress'               => floor($completed_applications/$total_applications*100),
            'completed_applications' => $completed_applications,
            'days_to_go'             => $target_date,
        ]);
    }

    public function brandTransition()
    {
        return view('landing-pages.brand-transition');
    }

    public function internationalRefinance()
    {
        $faqs                   = FaqGroup::find(FaqGroup::INTERNATIONAL_REFINANCE)->questions;
        $negotiationGroup       = NegotiationGroup::find(NegotiationGroup::NG_INTERNATIONAL_REFINANCE);
        $completed_applications = $negotiationGroup->users_count;
        $total_applications     = 2000;
        $progress               = floor($completed_applications/$total_applications*100);
        $refinance_amount       = $completed_applications * 95000;

        return view('landing-pages.international-refinance', [
            'faqs'                   => $faqs,
            'completed_applications' => $completed_applications,
            'total_applications'     => $total_applications,
            'progress'               => $progress,
            'refinance_amount'       => $refinance_amount,
        ]);
    }

    public function internationalRefinancePostAuth()
    {
        $faqs                   = FaqGroup::find(FaqGroup::INTERNATIONAL_REFINANCE)->questions;
        $negotiationGroup       = NegotiationGroup::find(NegotiationGroup::NG_INTERNATIONAL_REFINANCE);
        $completed_applications = $negotiationGroup->users_count;
        $total_applications     = 2000;
        $progress               = floor($completed_applications/$total_applications*100);
        $days_to_go             = Carbon::createFromDate(2021,03,15)->diffInDays();
        $refinance_amount       = $completed_applications * 95000;

        return view('landing-pages.post-auth.international-refinance', [
            'faqs'                   => $faqs,
            'completed_applications' => $completed_applications,
            'total_applications'     => $total_applications,
            'progress'               => $progress,
            'refinance_amount'       => $refinance_amount,
        ]);
    }

    public function academicYear2122Undergraduate()
    {
        $faqGroup               = FaqGroup::find(FaqGroup::UNDERGRADUATE_PAGE);
        $completed_applications = NegotiationGroup::find(NegotiationGroup::NG_DOMESTIC_GROUP_21_22)->users_count + 50;
        $total_applications     = 10000;
        $faqs                   = $faqGroup ? $faqGroup->questions : null;

        return view('landing-pages.campaigns.ay-2021-22-group', [
            'faqs'                   => $faqs,
            'progress'               => floor($completed_applications/$total_applications*100),
            'completed_applications' => $completed_applications,
            'total_applications' => $total_applications
        ]);
    }

    public function academicYear2122Graduate()
    {
        $faqGroup               = FaqGroup::find(FaqGroup::GRADUATE_PAGE);
        $completed_applications = NegotiationGroup::find(NegotiationGroup::NG_GRAD_21_22)->users_count + NegotiationGroup::find(NegotiationGroup::NG_MBA_21_22)->users_count + 100;
        $total_applications     = 8000;
        $faqs                   = $faqGroup ? $faqGroup->questions : null;

        return view('landing-pages.campaigns.ay-2021-22-group', [
            'faqs'                   => $faqs,
            'progress'               => floor($completed_applications/$total_applications*100),
            'completed_applications' => $completed_applications,
            'total_applications' => $total_applications
        ]);
    }

    public function academicYear2122Mba()
    {
        $faqGroup               = FaqGroup::find(FaqGroup::GRADUATE_PAGE);
        $completed_applications = NegotiationGroup::find(NegotiationGroup::NG_MBA_21_22)->users_count + 50;
        $total_applications     = 6000;
        $faqs                   = $faqGroup ? $faqGroup->questions : null;

        return view('landing-pages.campaigns.ay-2021-22-group', [
            'faqs'                   => $faqs,
            'progress'               => floor($completed_applications/$total_applications*100),
            'completed_applications' => $completed_applications,
            'total_applications' => $total_applications
        ]);
    }
}
