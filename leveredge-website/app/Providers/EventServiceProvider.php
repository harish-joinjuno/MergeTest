<?php

namespace App\Providers;

use App\Events\AccessTheDealStatusUpdated;
use App\Events\CampusAmbassadorTaskCompleted;
use App\Events\EmailEnteredOnAutoRefinanceApplication;
use App\Events\LeadCaptured;
use App\Events\MenuLinkChanged;
use App\Events\NewBoldStudent;
use App\Events\PingBold;
use App\Events\QuestionFlowValidationError;
use App\Events\ScholarshipEntrantCreated;
use App\Events\SchoolVsSchoolCompetitionEntered;
use App\Events\UpdateSociallyPowered;
use App\Events\UserPlacedInNegotiationGroup;
use App\Events\UserPlacedInReferralProgram;
use App\Events\UserProfileCompleted;
use App\Events\UserProfileRoleUpdated;
use App\Events\UserProfileUpdated;
use App\Listeners\AbandonmentEmailsListener;
use App\Listeners\BoldPingListener;
use App\Listeners\DestroyUserIdCookie;
use App\Listeners\HandlePhoneNumberAfterProfileCompleted;
use App\Listeners\MarkQuestionFlowResponderComplete;
use App\Listeners\MenuLinkChangeListener;
use App\Listeners\NotifyTaskCompletedToAdminListener;
use App\Listeners\PlaceBorrowerInReferralProgram;
use App\Listeners\QuestionFlowStartedListener;
use App\Listeners\QuestionFlowValidationErrorDatabaseListener;
use App\Listeners\QuestionFlowValidationErrorSlackListener;
use App\Listeners\RemoveBorrowerFromGmassMailChimp;
use App\Listeners\ReportViewContentToFacebook;
use App\Listeners\ScheduleMarketingEmailsForScholarshipEntrant;
use App\Listeners\SendEmailVerificationForCompetition;
use App\Listeners\SendLeadToMailchimp;
use App\Listeners\SetUserIdCookie;
use App\Listeners\SubscribeBoldStudentToMailChimp;
use App\Listeners\SubscribeUserInMailchimp;
use App\Listeners\SyncUserWithMailchimp;
use App\Listeners\UpdateHubspotPropertiesListener;

use App\Listeners\UpdateSociallyPoweredAccessTheDeal;
use App\Providers\App\Events\QuestionFlowCompleted;
use App\Providers\App\Events\QuestionFlowStarted;
use App\Providers\App\Listeners\ReassessBorrowerNegotiationGroup;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        LeadCaptured::class => [
            SendLeadToMailchimp::class,
        ],

        Registered::class => [
            SendEmailVerificationNotification::class,
            RemoveBorrowerFromGmassMailChimp::class,
            SubscribeUserInMailchimp::class,
            UpdateHubspotPropertiesListener::class,
            AbandonmentEmailsListener::class,
        ],

        UserProfileCompleted::class => [
            PlaceBorrowerInReferralProgram::class,
            HandlePhoneNumberAfterProfileCompleted::class,
            SyncUserWithMailchimp::class,
            UpdateHubspotPropertiesListener::class,
        ],

        UserProfileUpdated::class => [
            SyncUserWithMailchimp::class,
            ReassessBorrowerNegotiationGroup::class,
        ],

        Login::class => [
            SetUserIdCookie::class,
        ],

        Logout::class => [
            DestroyUserIdCookie::class,
        ],

        CampusAmbassadorTaskCompleted::class => [
            NotifyTaskCompletedToAdminListener::class,
        ],

        MenuLinkChanged::class => [
            MenuLinkChangeListener::class,
        ],

        SchoolVsSchoolCompetitionEntered::class => [
            SendEmailVerificationForCompetition::class,
        ],

        UserProfileRoleUpdated::class => [
            SyncUserWithMailchimp::class,
        ],

        UserPlacedInReferralProgram::class => [
            SyncUserWithMailchimp::class,
        ],

        UserPlacedInNegotiationGroup::class => [
            SyncUserWithMailchimp::class,
        ],

        NewBoldStudent::class => [
            SubscribeBoldStudentToMailChimp::class,
        ],

        AccessTheDealStatusUpdated::class => [
            UpdateHubspotPropertiesListener::class,
        ],

        UpdateSociallyPowered::class => [
            UpdateSociallyPoweredAccessTheDeal::class,
        ],

        PingBold::class => [
            BoldPingListener::class,
        ],

        EmailEnteredOnAutoRefinanceApplication::class => [
            ReportViewContentToFacebook::class,
        ],

        ScholarshipEntrantCreated::class => [
            ScheduleMarketingEmailsForScholarshipEntrant::class,
        ],

        QuestionFlowStarted::class => [
            QuestionFlowStartedListener::class,
        ],

        QuestionFlowCompleted::class => [
            MarkQuestionFlowResponderComplete::class,
        ],

        QuestionFlowValidationError::class => [
            QuestionFlowValidationErrorSlackListener::class,
            QuestionFlowValidationErrorDatabaseListener::class,
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}
