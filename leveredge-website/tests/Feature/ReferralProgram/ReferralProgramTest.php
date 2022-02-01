<?php

namespace Tests\Feature\ReferralProgram;

use App\AccessTheDeal;
use App\ContractType;
use App\Deal;
use App\DealStatus;
use App\Degree;
use App\Events\AccessTheDealStatusUpdated;
use App\Events\UserProfileCompleted;
use App\Facades\Mailchimp;
use App\Listeners\PlaceBorrowerInReferralProgram;
use App\PartnerType;
use App\ReferralProgram;
use App\ReferralProgramUser;
use App\ReferralRewardClaim;
use App\UserProfile;
use Carbon\Carbon;
use Tests\Builders\PartnerProfileBuilder;
use Tests\Builders\UserBuilder;
use Tests\Builders\UserProfileBuilder;
use Tests\Feature\FeatureTest;

class ReferralProgramTest extends FeatureTest
{
    /** @test */
    public function it_should_count_number_of_referred_users()
    {
        Mailchimp::shouldReceive('syncSubscriber');

        $user = (new UserBuilder())
        ->save()
        ->get();

        $userProfile = (new UserProfileBuilder())
            ->withUser($user)
            ->withLoanType(UserProfile::LOAN_TYPE_GRADUATE)
            ->withImmigrationStatus(UserProfile::IMMIGRATION_STATUS_US_CITIZEN_OR_PERMANENT_RESIDENT)
            ->withGradDegree(Degree::where('name', 'MBA')->first())
            ->save()
            ->get();

        $listener = new PlaceBorrowerInReferralProgram();
        $listener->handle(new UserProfileCompleted($user));

        (new UserBuilder())
            ->referredBy($user)
            ->save()
            ->get();

        (new UserBuilder())
            ->referredBy($user)
            ->save()
            ->get();

        (new UserBuilder())
            ->referredBy($user)
            ->save()
            ->get();

        $this->assertEquals(3, $user->currentReferralProgramUser()->getReferralsCount(), 'getReferralsCount is not counting referrals');
    }

    /** @test */
    public function it_should_count_number_of_successful_referred_users()
    {
        Mailchimp::shouldReceive('syncSubscriber');

        $user = (new UserBuilder())
            ->save()
            ->get();

        $userProfile = (new UserProfileBuilder())
            ->withUser($user)
            ->withLoanType(UserProfile::LOAN_TYPE_GRADUATE)
            ->withImmigrationStatus(UserProfile::IMMIGRATION_STATUS_US_CITIZEN_OR_PERMANENT_RESIDENT)
            ->withGradDegree(Degree::where('name', 'MBA')->first())
            ->save()
            ->get();

        $listener = new PlaceBorrowerInReferralProgram();
        $listener->handle(new UserProfileCompleted($user));

        $referred_user_1 = (new UserBuilder())
            ->referredBy($user)
            ->save()
            ->get();

        $referred_user_2 = (new UserBuilder())
            ->referredBy($user)
            ->save()
            ->get();

        $referred_user_3 = (new UserBuilder())
            ->referredBy($user)
            ->save()
            ->get();

        $access_the_deal              = new AccessTheDeal();
        $access_the_deal->user_id     = $referred_user_1->id;
        $access_the_deal->loan_status_id = DealStatus::SIGNED_THE_LOAN;
        $access_the_deal->deal_id     = Deal::SENT_TO_LAUREL_ROAD;
        $access_the_deal->save();

        $access_the_deal              = new AccessTheDeal();
        $access_the_deal->user_id     = $referred_user_2->id;
        $access_the_deal->loan_status_id = DealStatus::SIGNED_THE_LOAN;
        $access_the_deal->deal_id     = Deal::SENT_TO_LAUREL_ROAD;
        $access_the_deal->save();

        $access_the_deal              = new AccessTheDeal();
        $access_the_deal->user_id     = $referred_user_3->id;
        $access_the_deal->loan_status = '';
        $access_the_deal->deal_id     = Deal::SENT_TO_LAUREL_ROAD;
        $access_the_deal->save();

        $this->assertEquals(2, $user->currentReferralProgramUser()->getSuccessfulReferralsCount(), 'getSuccessfulReferralsCount is not counting referrals');
    }

    /** @test */
    public function it_should_calculate_pending_amount_for_milestone_prizes()
    {
        Mailchimp::shouldReceive('syncSubscriber');

        $user = (new UserBuilder())
            ->save()
            ->get();

        $userProfile = (new UserProfileBuilder())
            ->withUser($user)
            ->withLoanType(UserProfile::LOAN_TYPE_GRADUATE)
            ->withImmigrationStatus(UserProfile::IMMIGRATION_STATUS_US_CITIZEN_OR_PERMANENT_RESIDENT)
            ->withGradDegree(Degree::where('name', 'MBA')->first())
            ->save()
            ->get();

        $listener = new PlaceBorrowerInReferralProgram();
        $listener->handle(new UserProfileCompleted($user));

        (new UserBuilder())
            ->referredBy($user)
            ->save()
            ->get();

        (new UserBuilder())
            ->referredBy($user)
            ->save()
            ->get();

        (new UserBuilder())
            ->referredBy($user)
            ->save()
            ->get();

        $this->assertEquals(75, $user->currentReferralProgramUser()->getPendingAmount(), 'getPendingAmount is not counting calculating for MBA Student');
    }

    /** @test */
    public function it_should_calculate_earned_amount_for_milestone_prizes()
    {
        Mailchimp::shouldReceive('syncSubscriber');

        $user = (new UserBuilder())
            ->save()
            ->get();

        $userProfile = (new UserProfileBuilder())
            ->withUser($user)
            ->withLoanType(UserProfile::LOAN_TYPE_GRADUATE)
            ->withImmigrationStatus(UserProfile::IMMIGRATION_STATUS_US_CITIZEN_OR_PERMANENT_RESIDENT)
            ->withGradDegree(Degree::where('name', 'MBA')->first())
            ->save()
            ->get();

        $listener = new PlaceBorrowerInReferralProgram();
        $listener->handle(new UserProfileCompleted($user));

        $referred_user_1 = (new UserBuilder())
            ->referredBy($user)
            ->save()
            ->get();

        $referred_user_2 = (new UserBuilder())
            ->referredBy($user)
            ->save()
            ->get();

        $referred_user_3 = (new UserBuilder())
            ->referredBy($user)
            ->save()
            ->get();

        $access_the_deal              = new AccessTheDeal();
        $access_the_deal->user_id     = $referred_user_1->id;
        $access_the_deal->loan_status_id = DealStatus::SIGNED_THE_LOAN;
        $access_the_deal->deal_id     = Deal::SENT_TO_LAUREL_ROAD;
        $access_the_deal->save();

        $access_the_deal              = new AccessTheDeal();
        $access_the_deal->user_id     = $referred_user_2->id;
        $access_the_deal->loan_status_id = DealStatus::SIGNED_THE_LOAN;
        $access_the_deal->deal_id     = Deal::SENT_TO_LAUREL_ROAD;
        $access_the_deal->save();

        $access_the_deal              = new AccessTheDeal();
        $access_the_deal->user_id     = $referred_user_3->id;
        $access_the_deal->loan_status = '';
        $access_the_deal->deal_id     = Deal::SENT_TO_LAUREL_ROAD;
        $access_the_deal->save();

        $this->assertEquals(50, $user->currentReferralProgramUser()->getEarnedAmount(), 'getPendingAmount is not counting calculating for MBA Student');
    }

    /** @test */
    public function it_should_calculate_values_correctly_for_quarter_percent_of_first_loan()
    {
        $deal = new Deal();
        $deal->id = Deal::orderBy('id','desc')->first()->id + 1;
        $deal->slug = Deal::DEAL_EARNEST_UNDERGRAD_STUDENT_LOAN_20_21_SLUG;
        $deal->name = 'Earnest Deal';
        $deal->description = 'Earnest Deal';
        $deal->start_date = now();
        $deal->end_date = null;
        $deal->redirect_url =  'https://levere.co';
        $deal->tracked_query_parameter = 'utm_content';
        $deal->allow_guest_access = false;
        $deal->deal_type_id = 1;
        $deal->fee_type_id = 1;
        $deal->fee_amount = 0;
        $deal->reward_program = null;
        $deal->percentage_of_loan_amount = 0;
        $deal->save();

        $partner = (new UserBuilder())
            ->save()
            ->get();

        $partnerProfile = (new PartnerProfileBuilder())
            ->withUser($partner)
            ->withPartnerType(PartnerType::where('type',PartnerType::TYPE_CAMPUS_AMBASSADOR)->first())
            ->withContractType(ContractType::where('type',ContractType::TYPE_CAMPUS_AMBASSADOR)->first())
            ->save()
            ->get();

        $referralProgramUser                      = new ReferralProgramUser();
        $referralProgramUser->user_id             = $partner->id;
        $referralProgramUser->referral_program_id = ReferralProgram::where('slug',ReferralProgram::REFERRAL_PROGRAM_QUARTER_PERCENT_OF_FIRST_LOAN)->first()->id;
        $referralProgramUser->starts_on           = Carbon::today()->format('Y-m-d');
        $referralProgramUser->save();

        $referred_user_1 = (new UserBuilder())
            ->referredBy($partner)
            ->save()
            ->get();

        $referred_user_2 = (new UserBuilder())
            ->referredBy($partner)
            ->save()
            ->get();

        $referred_user_3 = (new UserBuilder())
            ->referredBy($partner)
            ->save()
            ->get();

        $this->assertEquals(3, $partner->currentReferralProgramUser()->getReferralsCount());
        $this->assertEquals(0, $partner->currentReferralProgramUser()->getPendingAmount());
        $this->assertEquals(0, $partner->currentReferralProgramUser()->getSuccessfulReferralsCount());
        $this->assertEquals(0, $partner->currentReferralProgramUser()->getEarnedAmount());
        $this->assertEquals(0, $partner->currentReferralProgramUser()->getPaidAmount());
        $this->assertEquals(0, $partner->currentReferralProgramUser()->getAmountToBePaid());

        // Simulate Referred User 1 clicks on a deal
        $access_the_deal                    = new AccessTheDeal();
        $access_the_deal->user_id           = $referred_user_1->id;
        $access_the_deal->loan_status_id    = DealStatus::CLICKED_TO_PROVIDER_ID;
        $access_the_deal->deal_id           = Deal::where('slug',Deal::DEAL_EARNEST_UNDERGRAD_STUDENT_LOAN_20_21_SLUG)->first()->id;
        $access_the_deal->save();

        $this->assertEquals(3, $partner->currentReferralProgramUser()->getReferralsCount());
        $this->assertEquals(0, $partner->currentReferralProgramUser()->getPendingAmount());
        $this->assertEquals(0, $partner->currentReferralProgramUser()->getSuccessfulReferralsCount());
        $this->assertEquals(0, $partner->currentReferralProgramUser()->getEarnedAmount());
        $this->assertEquals(0, $partner->currentReferralProgramUser()->getPaidAmount());
        $this->assertEquals(0, $partner->currentReferralProgramUser()->getAmountToBePaid());

        // Simulate Referred User 1 closes a loan
        $access_the_deal                    = new AccessTheDeal();
        $access_the_deal->user_id           = $referred_user_1->id;
        $access_the_deal->loan_status_id    = DealStatus::SIGNED_THE_LOAN;
        $access_the_deal->deal_id           = Deal::where('slug',Deal::DEAL_EARNEST_UNDERGRAD_STUDENT_LOAN_20_21_SLUG)->first()->id;
        $access_the_deal->loan_amount       = 20000;
        $access_the_deal->save();

        $this->assertEquals(3, $partner->currentReferralProgramUser()->getReferralsCount());
        $this->assertEquals(0, $partner->currentReferralProgramUser()->getPendingAmount());
        $this->assertEquals(1, $partner->currentReferralProgramUser()->getSuccessfulReferralsCount());
        $this->assertEquals(50, $partner->currentReferralProgramUser()->getEarnedAmount());
        $this->assertEquals(0, $partner->currentReferralProgramUser()->getPaidAmount());
        $this->assertEquals(50, $partner->currentReferralProgramUser()->getAmountToBePaid());

        // Simulate Partner files a claim
        $referralRewardClaim = new ReferralRewardClaim();
        $referralRewardClaim->referral_program_user_id = $partner->currentReferralProgramUser()->id;
        $referralRewardClaim->reward = 'cash';
        $referralRewardClaim->value = 50;
        $referralRewardClaim->status = 'pending';
        $referralRewardClaim->save();

        $this->assertEquals(3, $partner->currentReferralProgramUser()->getReferralsCount());
        $this->assertEquals(0, $partner->currentReferralProgramUser()->getPendingAmount());
        $this->assertEquals(1, $partner->currentReferralProgramUser()->getSuccessfulReferralsCount());
        $this->assertEquals(50, $partner->currentReferralProgramUser()->getEarnedAmount());
        $this->assertEquals(50, $partner->currentReferralProgramUser()->getPaidAmount());
        $this->assertEquals(0, $partner->currentReferralProgramUser()->getAmountToBePaid());

        // Simulate Referred User 2 closes a loan
        $access_the_deal                    = new AccessTheDeal();
        $access_the_deal->user_id           = $referred_user_2->id;
        $access_the_deal->loan_status_id    = DealStatus::SIGNED_THE_LOAN;
        $access_the_deal->deal_id           = Deal::where('slug',Deal::DEAL_EARNEST_UNDERGRAD_STUDENT_LOAN_20_21_SLUG)->first()->id;
        $access_the_deal->loan_amount       = 10000;
        $access_the_deal->save();

        $this->assertEquals(3, $partner->currentReferralProgramUser()->getReferralsCount());
        $this->assertEquals(0, $partner->currentReferralProgramUser()->getPendingAmount());
        $this->assertEquals(2, $partner->currentReferralProgramUser()->getSuccessfulReferralsCount());
        $this->assertEquals(75, $partner->currentReferralProgramUser()->getEarnedAmount());
        $this->assertEquals(50, $partner->currentReferralProgramUser()->getPaidAmount());
        $this->assertEquals(25, $partner->currentReferralProgramUser()->getAmountToBePaid());

        // Simulate Referred User 1 closes a second loan (this shouldn't change anything since it is a second loan)
        $access_the_deal                    = new AccessTheDeal();
        $access_the_deal->user_id           = $referred_user_2->id;
        $access_the_deal->loan_status_id    = DealStatus::SIGNED_THE_LOAN;
        $access_the_deal->deal_id           = Deal::where('slug',Deal::DEAL_EARNEST_UNDERGRAD_STUDENT_LOAN_20_21_SLUG)->first()->id;
        $access_the_deal->loan_amount       = 10000;
        $access_the_deal->save();

        $this->assertEquals(3, $partner->currentReferralProgramUser()->getReferralsCount());
        $this->assertEquals(0, $partner->currentReferralProgramUser()->getPendingAmount());
        $this->assertEquals(2, $partner->currentReferralProgramUser()->getSuccessfulReferralsCount());
        $this->assertEquals(75, $partner->currentReferralProgramUser()->getEarnedAmount());
        $this->assertEquals(50, $partner->currentReferralProgramUser()->getPaidAmount());
        $this->assertEquals(25, $partner->currentReferralProgramUser()->getAmountToBePaid());

    }
}
