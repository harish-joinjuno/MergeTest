<?php

namespace Tests\Feature\UserProfile;

use App\AcademicYear;
use App\Events\UserProfileCompleted;
use App\Listeners\HandlePhoneNumberAfterProfileCompleted;
use App\Mail\UserCreatedNotification;
use App\Notifications\WelcomeSms;
use App\Role;
use App\UserProfile;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Queue;
use Tests\Builders\AcademicYearBuilder;
use Tests\Builders\NegotiationGroupBuilder;
use Tests\Builders\NegotiationGroupEligibilityProfileBuilder;
use Tests\Builders\NegotiationGroupUserBuilder;
use Tests\Builders\UserBuilder;
use Tests\Builders\UserProfileBuilder;
use Tests\Feature\FeatureTest;

class UserProfileCompleted extends FeatureTest
{
    protected function setUp(): void
    {
        parent::setUp();

        (new AcademicYearBuilder())
            ->withRefinance()
            ->withName(AcademicYear::ACADEMIC_YEAR_REFINANCE)
            ->save();

        (new AcademicYearBuilder())
            ->withName(AcademicYear::ACADEMIC_YEAR_20_21)
            ->save();
    }

    /** @test */
    public function it_should_notificate_if_user_has_phone_number()
    {
        Queue::fake();
        Mail::fake();
        Notification::fake();

        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_BORROWER)
            ->get();

        $userProfile = (new UserProfileBuilder())
            ->withUser($user)
            ->withRole(UserProfile::ROLE_STUDENT)
            ->withPhoneNumber()
            ->withSignupProgress(UserProfile::SIGNUP_PROGRESS_FINANCIALS)
            ->save()
            ->get();

        //no cosigner
        $this
            ->withoutExceptionHandling()
            ->actingAs($user)
            ->post(route('user-profile.financials'), [
                'credit_score'           => UserProfile::CREDIT_SCORE_BETWEEN_750_AND_799,
                'annual_income'          => 100000,
                'cosigner_status'        => UserProfile::COSIGNER_STATUS_NO,
                'cosigner_credit_score'  => null,
                'cosigner_annual_income' => null,
                'cosigner_immigration_status' => null,
                'cosigner_country_of_citizenship_id' => null,
                'cosigner_country_of_residence_id' => null,
                'cosigner_visa_id' => null
            ])
            ->assertRedirect()
            ->assertSessionHasNoErrors();

        $listener = new HandlePhoneNumberAfterProfileCompleted();
        $listener->handle(new UserProfileCompleted($user));

        Mail::assertQueued(UserCreatedNotification::class);
        Notification::assertNotSentTo([$user], WelcomeSms::class);
    }

    /** @test */
    public function it_should_not_notificate_if_user_doesnt_have_phone_number()
    {
        Queue::fake();
        Mail::fake();
        Notification::fake();

        $knownDate = Carbon::create(2020, 5, 21);
        Carbon::setTestNow($knownDate);


        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_BORROWER)
            ->get();

        $userProfile = (new UserProfileBuilder())
            ->withUser($user)
            ->withLoanType(UserProfile::LOAN_TYPE_REFINANCE)
            ->withRole(UserProfile::ROLE_STUDENT)
            ->withImmigrationStatus(UserProfile::IMMIGRATION_STATUS_US_CITIZEN_OR_PERMANENT_RESIDENT)
            ->withSignupProgress(UserProfile::SIGNUP_PROGRESS_FINANCIALS)
            ->save()
            ->get();

        $academicYear = (new AcademicYearBuilder())
            ->withName('Test Academic Year')
            ->withStartsOn(Carbon::create(2020, 1, 1))
            ->withEndsOn(Carbon::create(2021, 1, 1))
            ->withRefinance(true)
            ->save()
            ->get();

        $negotiationGroup = (new NegotiationGroupBuilder())
            ->withName('Test Negotiation Group')
            ->withAcademicYear($academicYear)
            ->withSlug('test-negotiation-group')
            ->withDealConfidence(0)
            ->withPriority(1)
            ->save()
            ->get();

        $negotiationGroupEligibleProfile = (new NegotiationGroupEligibilityProfileBuilder())
            ->withNegotiationGroup($negotiationGroup)
            ->withImmigrationStatus(UserProfile::IMMIGRATION_STATUS_US_CITIZEN_OR_PERMANENT_RESIDENT)
            ->save()
            ->get();

//        $negotiationGroupUser = (new NegotiationGroupUserBuilder())
//            ->withUser($user)
//            ->withAcademicYear($academicYear)
//            ->withNegotiationGroup($negotiationGroup)
//            ->save()
//            ->get();

        //no cosigner
        $this
            ->withoutExceptionHandling()
            ->actingAs($user)
            ->post(route('user-profile.financials'), [
                'credit_score'           => UserProfile::CREDIT_SCORE_BETWEEN_750_AND_799,
                'annual_income'          => 100000,
                'cosigner_status'        => UserProfile::COSIGNER_STATUS_NO,
                'cosigner_credit_score'  => null,
                'cosigner_annual_income' => null,
                'cosigner_immigration_status' => null,
                'cosigner_country_of_citizenship_id' => null,
                'cosigner_country_of_residence_id' => null,
                'cosigner_visa_id' => null
            ])
            ->assertRedirect()
            ->assertSessionHasNoErrors();

        $listener = new HandlePhoneNumberAfterProfileCompleted();
        $listener->handle(new UserProfileCompleted($user));

        Mail::assertNotQueued(UserCreatedNotification::class);
        Notification::assertNotSentTo([$user], WelcomeSms::class);
    }
}
