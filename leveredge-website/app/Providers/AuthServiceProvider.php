<?php

namespace App\Providers;

use App\AcademicYear;
use App\AccessTheDeal;
use App\ActionNotification;
use App\AnalyticsSourceRule;
use App\BlogPost;
use App\CampusAmbassadorTask;
use App\CareerOneStopScholarship;
use App\Client;
use App\ClientEvent;
use App\CompletedCampusAmbassadorTask;
use App\Content;
use App\ContractType;
use App\ContractTypeMetric;
use App\Country;
use App\Deal;
use App\DealStatus;
use App\DealStatusApplicability;
use App\DealType;
use App\Degree;
use App\DeleteRequest;
use App\Experiment;
use App\ExperimentType;
use App\Faq;
use App\FaqGroup;
use App\FederalLoanTracker;
use App\FederalLoanTrackerEmail;
use App\FeeType;
use App\File;
use App\FinancialAidTrackerEligibleProgram;
use App\FootNote;
use App\GradDegree;
use App\HeardFromOption;
use App\InfoCardElement;
use App\InternalIpAddress;
use App\InternationalStudentHealthInsuranceClaim;
use App\LandingPage;
use App\LandingPageTemplate;
use App\LawScholarship;
use App\LawSchool;
use App\LeveredgeRewardClaim;
use App\LeveredgeRewardDistribution;
use App\MagicLoginLink;
use App\MailchimpAutomatedCampaign;
use App\MailchimpAutomatedCampaignMailable;
use App\MailchimpAutomatedCampaignUser;
use App\MarketingEmail;
use App\MarketingEmailTemplate;
use App\MarketingEmailUnsubscribe;
use App\MbaScholarship;
use App\MenuLink;
use App\Metric;
use App\NegotiationGroup;
use App\NegotiationGroupAnnouncement;
use App\NegotiationGroupEligibleProfile;
use App\NegotiationGroupEndScreen;
use App\NegotiationGroupFaq;
use App\NegotiationGroupFaqCategory;
use App\NegotiationGroupUser;
use App\NegotiationGroupUserExclusion;
use App\NegotiationGroupUserLeave;
use App\NovaResourcePermission;
use App\NovaUser;
use App\PageSection;
use App\PartnerClaim;
use App\PartnerProfile;
use App\PartnerType;
use App\Payment;
use App\PaymentMethod;
use App\Policies\Nova\AcademicYearPolicy;
use App\Policies\Nova\AccessTheDealPolicy;
use App\Policies\Nova\ActionNotificationPolicy;
use App\Policies\Nova\AnalyticsSourceRulePolicy;
use App\Policies\Nova\BlogPostPolicy;
use App\Policies\Nova\CampusAmbassadorTaskPolicy;
use App\Policies\Nova\CareerOneStopScholarshipPolicy;
use App\Policies\Nova\ClientEventPolicy;
use App\Policies\Nova\ClientPolicy;
use App\Policies\Nova\CompletedCampusAmbassadorTaskPolicy;
use App\Policies\Nova\ContentPolicy;
use App\Policies\Nova\ContractTypeMetricPolicy;
use App\Policies\Nova\ContractTypePolicy;
use App\Policies\Nova\CountryPolicy;
use App\Policies\Nova\DealPolicy;
use App\Policies\Nova\DealStatusApplicabilityPolicy;
use App\Policies\Nova\DealStatusPolicy;
use App\Policies\Nova\DealTypePolicy;
use App\Policies\Nova\DegreePolicy;
use App\Policies\Nova\DeleteRequestPolicy;
use App\Policies\Nova\ExperimentPolicy;
use App\Policies\Nova\ExperimentTypePolicy;
use App\Policies\Nova\FaqGroupPolicy;
use App\Policies\Nova\FaqPolicy;
use App\Policies\Nova\FederalLoanTrackerEmailPolicy;
use App\Policies\Nova\FederalLoanTrackerPolicy;
use App\Policies\Nova\FeeTypePolicy;
use App\Policies\Nova\FilePolicy;
use App\Policies\Nova\FinancialAidTrackerEligibleProgramPolicy;
use App\Policies\Nova\FootNotePolicy;
use App\Policies\Nova\GradDegreePolicy;
use App\Policies\Nova\HeardFromOptionPolicy;
use App\Policies\Nova\InfoCardElementPolicy;
use App\Policies\Nova\InternalIpAddressPolicy;
use App\Policies\Nova\InternationalStudentHealthInsuranceClaimPolicy;
use App\Policies\Nova\LandingPagePolicy;
use App\Policies\Nova\LandingPageTemplatePolicy;
use App\Policies\Nova\LawScholarshipPolicy;
use App\Policies\Nova\LawSchoolPolicy;
use App\Policies\Nova\LeveredgeRewardClaimPolicy;
use App\Policies\Nova\LeveredgeRewardDistributionPolicy;
use App\Policies\Nova\MagicLoginLinkPolicy;
use App\Policies\Nova\MailchimpAutomatedCampaignMailablePolicy;
use App\Policies\Nova\MailchimpAutomatedCampaignPolicy;
use App\Policies\Nova\MailchimpAutomatedCampaignUsersPolicy;
use App\Policies\Nova\MarketingEmailPolicy;
use App\Policies\Nova\MarketingEmailTemplatePolicy;
use App\Policies\Nova\MarketingEmailUnsubscribePolicy;
use App\Policies\Nova\MbaScholarshipPolicy;
use App\Policies\Nova\MenuLinkPolicy;
use App\Policies\Nova\MetricPolicy;
use App\Policies\Nova\NegotiationGroupAnnouncementPolicy;
use App\Policies\Nova\NegotiationGroupEligibleProfilePolicy;
use App\Policies\Nova\NegotiationGroupEndScreenPolicy;
use App\Policies\Nova\NegotiationGroupFaqCategoryPolicy;
use App\Policies\Nova\NegotiationGroupFaqPolicy;
use App\Policies\Nova\NegotiationGroupPolicy;
use App\Policies\Nova\NegotiationGroupUserExclusionPolicy;
use App\Policies\Nova\NegotiationGroupUserLeavePolicy;
use App\Policies\Nova\NegotiationGroupUserPolicy;
use App\Policies\Nova\NovaResourcePermissionPolicy;
use App\Policies\Nova\NovaUserPolicy;
use App\Policies\Nova\PageSectionPolicy;
use App\Policies\Nova\PartnerClaimPolicy;
use App\Policies\Nova\PartnerPolicy;
use App\Policies\Nova\PartnerTypePolicy;
use App\Policies\Nova\PaymentMethodPolicy;
use App\Policies\Nova\PaymentPolicy;
use App\Policies\Nova\PressPolicy;
use App\Policies\Nova\PressReleasePolicy;
use App\Policies\Nova\QuestionFlowPolicy;
use App\Policies\Nova\QuestionFlowResponderPolicy;
use App\Policies\Nova\QuestionFlowValidationErrorPolicy;
use App\Policies\Nova\QuestionPagePolicy;
use App\Policies\Nova\QuestionPageResponderPolicy;
use App\Policies\Nova\QuestionPolicy;
use App\Policies\Nova\QuestionResponderPolicy;
use App\Policies\Nova\RatePolicy;
use App\Policies\Nova\RatePropertyPolicy;
use App\Policies\Nova\RedirectPolicy;
use App\Policies\Nova\ReferralProgramEligibleProfilePolicy;
use App\Policies\Nova\ReferralProgramPolicy;
use App\Policies\Nova\ReferralProgramUserPolicy;
use App\Policies\Nova\ReferralRewardClaimPolicy;
use App\Policies\Nova\RolePolicy;
use App\Policies\Nova\ScholarshipContentPolicy;
use App\Policies\Nova\ScholarshipEmailPolicy;
use App\Policies\Nova\ScholarshipEntrantPolicy;
use App\Policies\Nova\ScholarshipPolicy;
use App\Policies\Nova\ScholarshipQuestionPolicy;
use App\Policies\Nova\ScholarshipTemplatePolicy;
use App\Policies\Nova\ScholarshipWinnerPolicy;
use App\Policies\Nova\SchoolVsSchoolCompetitionEntrantPolicy;
use App\Policies\Nova\SchoolVsSchoolCompetitionPolicy;
use App\Policies\Nova\ScreenshotClaimPolicy;
use App\Policies\Nova\SimpleActionNotificationRulePolicy;
use App\Policies\Nova\SocialProviderPolicy;
use App\Policies\Nova\TableauDashboardPolicy;
use App\Policies\Nova\TrackedLinkPolicy;
use App\Policies\Nova\TuitionDueDateProgramPolicy;
use App\Policies\Nova\UndergradDegreePolicy;
use App\Policies\Nova\UniversityPolicy;
use App\Policies\Nova\UserPolicy;
use App\Policies\Nova\UserProfileHeardFromOtherPolicy;
use App\Policies\Nova\UserProfilePolicy;
use App\Policies\Nova\VisaPolicy;
use App\Press;
use App\PressRelease;
use App\Question;
use App\QuestionFlow;
use App\QuestionFlowResponder;
use App\QuestionFlowValidationError;
use App\QuestionPage;
use App\QuestionPageResponder;
use App\QuestionResponder;
use App\Rate;
use App\RateProperty;
use App\Redirect;
use App\ReferralProgram;
use App\ReferralProgramEligibleProfile;
use App\ReferralProgramUser;
use App\ReferralRewardClaim;
use App\Role;
use App\Scholarship;
use App\ScholarshipContent;
use App\ScholarshipEmail;
use App\ScholarshipEntrant;
use App\ScholarshipQuestion;
use App\ScholarshipTemplate;
use App\ScholarshipWinner;
use App\SchoolVsSchoolCompetition;
use App\SchoolVsSchoolCompetitionEntrant;
use App\ScreenshotClaim;
use App\SimpleActionNotificationRule;
use App\SocialProvider;
use App\TableauDashboard;
use App\TrackedLink;
use App\UndergraduateDegree;
use App\University;
use App\User;
use App\UserProfile;
use App\UserProfileHeardFromOther;
use App\Visa;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Nova;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    protected $novaPolicies = [
        NovaResourcePermission::class                   => NovaResourcePermissionPolicy::class,
        Degree::class                                   => DegreePolicy::class,
        MenuLink::class                                 => MenuLinkPolicy::class,
        PageSection::class                              => PageSectionPolicy::class,
        Role::class                                     => RolePolicy::class,
        University::class                               => UniversityPolicy::class,
        UserProfile::class                              => UserProfilePolicy::class,
        User::class                                     => UserPolicy::class,
        CampusAmbassadorTask::class                     => CampusAmbassadorTaskPolicy::class,
        CompletedCampusAmbassadorTask::class            => CompletedCampusAmbassadorTaskPolicy::class,
        AccessTheDeal::class                            => AccessTheDealPolicy::class,
        DealType::class                                 => DealTypePolicy::class,
        Deal::class                                     => DealPolicy::class,
        FeeType::class                                  => FeeTypePolicy::class,
        MarketingEmailTemplate::class                   => MarketingEmailTemplatePolicy::class,
        MarketingEmailUnsubscribe::class                => MarketingEmailUnsubscribePolicy::class,
        MarketingEmail::class                           => MarketingEmailPolicy::class,
        AcademicYear::class                             => AcademicYearPolicy::class,
        NegotiationGroupAnnouncement::class             => NegotiationGroupAnnouncementPolicy::class,
        NegotiationGroupEligibleProfile::class          => NegotiationGroupEligibleProfilePolicy::class,
        NegotiationGroupFaq::class                      => NegotiationGroupFaqPolicy::class,
        NegotiationGroupUser::class                     => NegotiationGroupUserPolicy::class,
        FinancialAidTrackerEligibleProgram::class       => FinancialAidTrackerEligibleProgramPolicy::class,
        PressRelease::class                             => PressReleasePolicy::class,
        Press::class                                    => PressPolicy::class,
        TrackedLink::class                              => TrackedLinkPolicy::class,
        ContractType::class                             => ContractTypePolicy::class,
        LandingPage::class                              => LandingPagePolicy::class,
        PartnerType::class                              => PartnerTypePolicy::class,
        PaymentMethod::class                            => PaymentMethodPolicy::class,
        Payment::class                                  => PaymentPolicy::class,
        ReferralProgramEligibleProfile::class           => ReferralProgramEligibleProfilePolicy::class,
        ReferralProgramUser::class                      => ReferralProgramUserPolicy::class,
        ReferralProgram::class                          => ReferralProgramPolicy::class,
        ReferralRewardClaim::class                      => ReferralRewardClaimPolicy::class,
        LawScholarship::class                           => LawScholarshipPolicy::class,
        MbaScholarship::class                           => MbaScholarshipPolicy::class,
        NegotiationGroupFaqCategory::class              => NegotiationGroupFaqCategoryPolicy::class,
        NegotiationGroup::class                         => NegotiationGroupPolicy::class,
        LawSchool::class                                => LawSchoolPolicy::class,
        PartnerProfile::class                           => PartnerPolicy::class,
        NovaUser::class                                 => NovaUserPolicy::class,
        GradDegree::class                               => GradDegreePolicy::class,
        UndergraduateDegree::class                      => UndergradDegreePolicy::class,
        ActionNotification::class                       => ActionNotificationPolicy::class,
        SimpleActionNotificationRule::class             => SimpleActionNotificationRulePolicy::class,
        DealStatusApplicability::class                  => DealStatusApplicabilityPolicy::class,
        DealStatus::class                               => DealStatusPolicy::class,
        NegotiationGroupEndScreen::class                => NegotiationGroupEndScreenPolicy::class,
        Country::class                                  => CountryPolicy::class,
        FaqGroup::class                                 => FaqGroupPolicy::class,
        Faq::class                                      => FaqPolicy::class,
        File::class                                     => FilePolicy::class,
        InfoCardElement::class                          => InfoCardElementPolicy::class,
        LeveredgeRewardClaim::class                     => LeveredgeRewardClaimPolicy::class,
        Visa::class                                     => VisaPolicy::class,
        MailchimpAutomatedCampaign::class               => MailchimpAutomatedCampaignPolicy::class,
        MailchimpAutomatedCampaignUser::class           => MailchimpAutomatedCampaignUsersPolicy::class,
        HeardFromOption::class                          => HeardFromOptionPolicy::class,
        InternationalStudentHealthInsuranceClaim::class => InternationalStudentHealthInsuranceClaimPolicy::class,
        Metric::class                                   => MetricPolicy::class,
        LeveredgeRewardDistribution::class              => LeveredgeRewardDistributionPolicy::class,
        NegotiationGroupUserExclusion::class            => NegotiationGroupUserExclusionPolicy::class,
        ContractTypeMetric::class                       => ContractTypeMetricPolicy::class,
        Rate::class                                     => RatePolicy::class,
        RateProperty::class                             => RatePropertyPolicy::class,
        LandingPageTemplate::class                      => LandingPageTemplatePolicy::class,
        ScholarshipContent::class                       => ScholarshipContentPolicy::class,
        ScholarshipEmail::class                         => ScholarshipEmailPolicy::class,
        ScholarshipEntrant::class                       => ScholarshipEntrantPolicy::class,
        ScholarshipQuestion::class                      => ScholarshipQuestionPolicy::class,
        ScholarshipTemplate::class                      => ScholarshipTemplatePolicy::class,
        ScholarshipWinner::class                        => ScholarshipWinnerPolicy::class,
        Scholarship::class                              => ScholarshipPolicy::class,
        BlogPost::class                                 => BlogPostPolicy::class,
        Experiment::class                               => ExperimentPolicy::class,
        ExperimentType::class                           => ExperimentTypePolicy::class,
        InternalIpAddress::class                        => InternalIpAddressPolicy::class,
        ScreenshotClaim::class                          => ScreenshotClaimPolicy::class,
        AnalyticsSourceRule::class                      => AnalyticsSourceRulePolicy::class,
        FederalLoanTrackerEmail::class                  => FederalLoanTrackerEmailPolicy::class,
        FederalLoanTracker::class                       => FederalLoanTrackerPolicy::class,
        CareerOneStopScholarship::class                 => CareerOneStopScholarshipPolicy::class,
        ClientEvent::class                              => ClientEventPolicy::class,
        Client::class                                   => ClientPolicy::class,
        Content::class                                  => ContentPolicy::class,
        DeleteRequest::class                            => DeleteRequestPolicy::class,
        FootNote::class                                 => FootNotePolicy::class,
        MagicLoginLink::class                           => MagicLoginLinkPolicy::class,
        MailchimpAutomatedCampaignMailable::class       => MailchimpAutomatedCampaignMailablePolicy::class,
        NegotiationGroupUserLeave::class                => NegotiationGroupUserLeavePolicy::class,
        QuestionFlowResponder::class                    => QuestionFlowResponderPolicy::class,
        QuestionFlowValidationError::class              => QuestionFlowValidationErrorPolicy::class,
        QuestionPageResponder::class                    => QuestionPageResponderPolicy::class,
        QuestionResponder::class                        => QuestionResponderPolicy::class,
        Redirect::class                                 => RedirectPolicy::class,
        SocialProvider::class                           => SocialProviderPolicy::class,
        TableauDashboard::class                         => TableauDashboardPolicy::class,
        PartnerClaim::class                             => PartnerClaimPolicy::class,
        QuestionFlow::class                             => QuestionFlowPolicy::class,
        QuestionPage::class                             => QuestionPagePolicy::class,
        Question::class                                 => QuestionPolicy::class,
        SchoolVsSchoolCompetitionEntrant::class         => SchoolVsSchoolCompetitionEntrantPolicy::class,
        SchoolVsSchoolCompetition::class                => SchoolVsSchoolCompetitionPolicy::class,
        UserProfileHeardFromOther::class                => UserProfileHeardFromOtherPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Nova::serving(function () {
            $this->registerNovaPolicies();
        });
    }

    public function registerNovaPolicies()
    {
        foreach ($this->novaPolicies as $key => $value) {
            Gate::policy($key, $value);
        }
    }
}
