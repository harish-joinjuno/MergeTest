<?php

namespace Tests\Feature\ReferralProgram;

use App\Degree;
use App\Events\UserPlacedInReferralProgram;
use App\Events\UserProfileCompleted;
use App\Facades\Mailchimp;
use App\Listeners\PlaceBorrowerInReferralProgram;
use App\ReferralProgram;
use App\UserProfile;
use Illuminate\Support\Facades\Event;
use Tests\Builders\UserBuilder;
use Tests\Builders\UserProfileBuilder;
use Tests\Feature\FeatureTest;

class PlaceBorrowerInReferralProgramTest extends FeatureTest
{
    /** @test */
    public function it_should_place_mba_borrower_in_milestone_referral_program()
    {
        Mailchimp::shouldReceive('syncSubscriber');

        $user = (new UserBuilder())
            ->save()
            ->withFirstName()
            ->withLastName()
            ->get();

        $userProfile = (new UserProfileBuilder())
            ->withUser($user)
            ->withLoanType(UserProfile::LOAN_TYPE_GRADUATE)
            ->withImmigrationStatus(UserProfile::IMMIGRATION_STATUS_US_CITIZEN_OR_PERMANENT_RESIDENT)
            ->withGradDegree(Degree::where('name', 'MBA')->first())
            ->save()
            ->get();

        $referralProgram = ReferralProgram::where('slug', ReferralProgram::REFERRAL_PROGRAM_SLUG_TWO_SIDE_WITH_MILESTONE_PRIZES)
            ->first();

        $listener = new PlaceBorrowerInReferralProgram();
        $listener->handle(new UserProfileCompleted($user));

        $this->assertDatabaseHas('referral_program_users', [
            'user_id'             => $user->id,
            'referral_program_id' => $referralProgram->id,
        ]);
    }

    /** @test */
    public function it_should_place_non_mba_borrower_in_milestone_referral_program()
    {
        Mailchimp::shouldReceive('syncSubscriber');
        $user = (new UserBuilder())
            ->save()
            ->withFirstName()
            ->withLastName()
            ->get();

        $userProfile = (new UserProfileBuilder())
            ->withUser($user)
            ->withLoanType(UserProfile::LOAN_TYPE_GRADUATE)
            ->withImmigrationStatus(UserProfile::IMMIGRATION_STATUS_US_CITIZEN_OR_PERMANENT_RESIDENT)
            ->withGradDegree(Degree::where('name', 'Dental')->first())
            ->save()
            ->get();

        $referralProgram = ReferralProgram::where('slug', ReferralProgram::REFERRAL_PROGRAM_SLUG_TWO_SIDE_WITH_MILESTONE_PRIZES)
            ->first();

        $listener = new PlaceBorrowerInReferralProgram();
        $listener->handle(new UserProfileCompleted($user));

        $this->assertDatabaseHas('referral_program_users', [
            'user_id'             => $user->id,
            'referral_program_id' => $referralProgram->id,
        ]);
    }

    /** @test */
    public function it_should_emit_event_on_placing_user_on_referral_program()
    {
        Event::fake();

        $user = (new UserBuilder())
            ->save()
            ->withFirstName()
            ->withLastName()
            ->get();

        $userProfile = (new UserProfileBuilder())
            ->withUser($user)
            ->withLoanType(UserProfile::LOAN_TYPE_GRADUATE)
            ->withImmigrationStatus(UserProfile::IMMIGRATION_STATUS_US_CITIZEN_OR_PERMANENT_RESIDENT)
            ->withGradDegree(Degree::where('name', 'Dental')->first())
            ->save()
            ->get();

        $referralProgram = ReferralProgram::where('slug', ReferralProgram::REFERRAL_PROGRAM_SLUG_TWO_SIDE_WITH_MILESTONE_PRIZES)
            ->first();

        $listener = new PlaceBorrowerInReferralProgram();
        $listener->handle(new UserProfileCompleted($user));

        $this->assertDatabaseHas('referral_program_users', [
            'user_id'             => $user->id,
            'referral_program_id' => $referralProgram->id,
        ]);

        Event::assertDispatched(UserPlacedInReferralProgram::class, function($event) use ($user) {
            return $event->user->id == $user->id;
        });
    }
}
