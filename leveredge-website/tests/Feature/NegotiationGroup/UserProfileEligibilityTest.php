<?php

namespace Tests\Feature\NegotiationGroup;

use App\UserProfile;
use Tests\Builders\NegotiationGroupBuilder;
use Tests\Builders\NegotiationGroupEligibilityProfileBuilder;
use Tests\Builders\UserBuilder;
use Tests\Builders\UserProfileBuilder;
use Tests\Feature\FeatureTest;

class UserProfileEligibilityTest extends FeatureTest
{
    /** @test */
    public function it_should_be_eligible_if_is_the_right_immigration_status()
    {
        $negotiationGroup = (new NegotiationGroupBuilder())
            ->withAcademicYear()
            ->withPriority(1)
            ->save()
            ->get();

        $eligibleProfile = (new NegotiationGroupEligibilityProfileBuilder())
            ->withNegotiationGroup($negotiationGroup)
            ->withImmigrationStatus(UserProfile::IMMIGRATION_STATUS_US_CITIZEN_OR_PERMANENT_RESIDENT)
            ->withGradDegree()
            ->withGradUniversity()
            ->save()
            ->get();

        $user = (new UserBuilder())
            ->save()
            ->get();

        $userProfile = (new UserProfileBuilder())
            ->withUser($user)
            ->withLoanType(UserProfile::LOAN_TYPE_GRADUATE)
            ->withImmigrationStatus(UserProfile::IMMIGRATION_STATUS_US_CITIZEN_OR_PERMANENT_RESIDENT)
            ->withGradDegree($eligibleProfile->gradDegree)
            ->withGradUniversity($eligibleProfile->gradUniversity)
            ->save()
            ->get();

        $this->assertNotNull($userProfile->matchingEligibleProfile($negotiationGroup));
    }

    /** @test */
    public function it_should_NOT_be_eligible_if_is_not_the_right_immigration_status()
    {
        $negotiationGroup = (new NegotiationGroupBuilder())
            ->withPriority(1)
            ->withAcademicYear()
            ->save()
            ->get();

        $eligibleProfile = (new NegotiationGroupEligibilityProfileBuilder())
            ->withNegotiationGroup($negotiationGroup)
            ->withImmigrationStatus(UserProfile::IMMIGRATION_STATUS_US_CITIZEN_OR_PERMANENT_RESIDENT)
            ->withGradDegree()
            ->withGradUniversity()
            ->save()
            ->get();

        $user = (new UserBuilder())
            ->save()
            ->get();

        $userProfile = (new UserProfileBuilder())
            ->withUser($user)
            ->withLoanType(UserProfile::LOAN_TYPE_GRADUATE)
            ->withImmigrationStatus(UserProfile::IMMIGRATION_STATUS_OTHER)
            ->withGradDegree($eligibleProfile->gradDegree)
            ->withGradUniversity($eligibleProfile->gradUniversity)
            ->save()
            ->get();

        $this->assertNull($userProfile->matchingEligibleProfile($negotiationGroup));
    }

    /** @test */
    public function it_should_be_eligible_if_annual_income_equal_minimum()
    {
        $negotiationGroup = (new NegotiationGroupBuilder())
            ->withPriority(1)
            ->withAcademicYear()
            ->save()
            ->get();

        $eligibleProfile = (new NegotiationGroupEligibilityProfileBuilder())
            ->withNegotiationGroup($negotiationGroup)
            ->withAnnualIncomeMin(100)
            ->save()
            ->get();

        $user = (new UserBuilder())
            ->save()
            ->get();

        $userProfile = (new UserProfileBuilder())
            ->withUser($user)
            ->withLoanType(UserProfile::LOAN_TYPE_UNDERGRADUATE)
            ->withAnnualIncome($eligibleProfile->annual_income_min)
            ->save()
            ->get();

        $this->assertNotNull($userProfile->matchingEligibleProfile($negotiationGroup));
    }

    /** @test */
    public function it_should_be_eligible_if_annual_income_above_minimum()
    {
        $negotiationGroup = (new NegotiationGroupBuilder())
            ->withPriority(1)
            ->withAcademicYear()
            ->save()
            ->get();

        $eligibleProfile = (new NegotiationGroupEligibilityProfileBuilder())
            ->withNegotiationGroup($negotiationGroup)
            ->withAnnualIncomeMin(100)
            ->save()
            ->get();

        $user = (new UserBuilder())
            ->save()
            ->get();

        $userProfile = (new UserProfileBuilder())
            ->withUser($user)
            ->withLoanType(UserProfile::LOAN_TYPE_UNDERGRADUATE)
            ->withAnnualIncome($eligibleProfile->annual_income_min + 10)
            ->save()
            ->get();

        $this->assertNotNull($userProfile->matchingEligibleProfile($negotiationGroup));
    }

    /** @test */
    public function it_should_NOT_be_eligible_if_annual_income_bellow_minimum()
    {
        $negotiationGroup = (new NegotiationGroupBuilder())
            ->withPriority(1)
            ->withAcademicYear()
            ->save()
            ->get();

        $eligibleProfile = (new NegotiationGroupEligibilityProfileBuilder())
            ->withNegotiationGroup($negotiationGroup)
            ->withAnnualIncomeMin(100)
            ->save()
            ->get();

        $user = (new UserBuilder())
            ->save()
            ->get();

        $userProfile = (new UserProfileBuilder())
            ->withUser($user)
            ->withLoanType(UserProfile::LOAN_TYPE_UNDERGRADUATE)
            ->withAnnualIncome($eligibleProfile->annual_income_min - 10)
            ->save()
            ->get();

        $this->assertNull($userProfile->matchingEligibleProfile($negotiationGroup));
    }

    /** @test */
    public function it_should_be_eligible_if_annual_income_equal_maximum()
    {
        $negotiationGroup = (new NegotiationGroupBuilder())
            ->withPriority(1)
            ->withAcademicYear()
            ->save()
            ->get();

        $eligibleProfile = (new NegotiationGroupEligibilityProfileBuilder())
            ->withNegotiationGroup($negotiationGroup)
            ->withAnnualIncomeMax(100)
            ->save()
            ->get();

        $user = (new UserBuilder())
            ->save()
            ->get();

        $userProfile = (new UserProfileBuilder())
            ->withUser($user)
            ->withLoanType(UserProfile::LOAN_TYPE_UNDERGRADUATE)
            ->withAnnualIncome($eligibleProfile->annual_income_max)
            ->save()
            ->get();

        $this->assertNotNull($userProfile->matchingEligibleProfile($negotiationGroup));
    }

    /** @test */
    public function it_should_be_eligible_if_annual_income_bellow_max()
    {
        $negotiationGroup = (new NegotiationGroupBuilder())
            ->withPriority(1)
            ->withAcademicYear()
            ->save()
            ->get();

        $eligibleProfile = (new NegotiationGroupEligibilityProfileBuilder())
            ->withNegotiationGroup($negotiationGroup)
            ->withAnnualIncomeMax(100)
            ->save()
            ->get();

        $user = (new UserBuilder())
            ->save()
            ->get();

        $userProfile = (new UserProfileBuilder())
            ->withUser($user)
            ->withLoanType(UserProfile::LOAN_TYPE_UNDERGRADUATE)
            ->withAnnualIncome($eligibleProfile->annual_income_max - 10)
            ->save()
            ->get();

        $this->assertNotNull($userProfile->matchingEligibleProfile($negotiationGroup));
    }

    /** @test */
    public function it_should_NOT_be_eligible_if_annual_income_above_maximum()
    {
        $negotiationGroup = (new NegotiationGroupBuilder())
            ->withPriority(1)
            ->withAcademicYear()
            ->save()
            ->get();

        $eligibleProfile = (new NegotiationGroupEligibilityProfileBuilder())
            ->withNegotiationGroup($negotiationGroup)
            ->withAnnualIncomeMax(100)
            ->save()
            ->get();

        $user = (new UserBuilder())
            ->save()
            ->get();

        $userProfile = (new UserProfileBuilder())
            ->withUser($user)
            ->withLoanType(UserProfile::LOAN_TYPE_UNDERGRADUATE)
            ->withAnnualIncome($eligibleProfile->annual_income_max + 10)
            ->save()
            ->get();

        $this->assertNull($userProfile->matchingEligibleProfile($negotiationGroup));
    }

    /** @test */
    public function it_should_be_eligible_if_in_degree()
    {
        $negotiationGroup = (new NegotiationGroupBuilder())
            ->withPriority(1)
            ->withAcademicYear()
            ->save()
            ->get();

        $eligibleProfile = (new NegotiationGroupEligibilityProfileBuilder())
            ->withNegotiationGroup($negotiationGroup)
            ->withGradDegree()
            ->save()
            ->get();

        $user = (new UserBuilder())
            ->save()
            ->get();

        $userProfile = (new UserProfileBuilder())
            ->withUser($user)
            ->withLoanType(UserProfile::LOAN_TYPE_GRADUATE)
            ->withGradDegree($eligibleProfile->gradDegree)
            ->save()
            ->get();

        $this->assertNotNull($userProfile->matchingEligibleProfile($negotiationGroup));
    }

    /** @test */
    public function it_should_NOT_be_eligible_if_not_in_degree()
    {
        $negotiationGroup = (new NegotiationGroupBuilder())
            ->withPriority(1)
            ->withAcademicYear()
            ->save()
            ->get();

        $eligibleProfile = (new NegotiationGroupEligibilityProfileBuilder())
            ->withNegotiationGroup($negotiationGroup)
            ->withImmigrationStatus(UserProfile::IMMIGRATION_STATUS_US_CITIZEN_OR_PERMANENT_RESIDENT)
            ->withGradDegree()
            ->withGradUniversity()
            ->save()
            ->get();

        $user = (new UserBuilder())
            ->save()
            ->get();

        $userProfile = (new UserProfileBuilder())
            ->withUser($user)
            ->withLoanType(UserProfile::LOAN_TYPE_UNDERGRADUATE)
            ->withImmigrationStatus(UserProfile::IMMIGRATION_STATUS_US_CITIZEN_OR_PERMANENT_RESIDENT)
            ->withGradDegree()
            ->withGradUniversity($eligibleProfile->gradUniversity)
            ->save()
            ->get();

        $this->assertNull($userProfile->matchingEligibleProfile($negotiationGroup));
    }

    /** @test */
    public function it_should_be_eligible_if_in_valid_university()
    {
        $negotiationGroup = (new NegotiationGroupBuilder())
            ->withPriority(1)
            ->withAcademicYear()
            ->save()
            ->get();

        $eligibleProfile = (new NegotiationGroupEligibilityProfileBuilder())
            ->withNegotiationGroup($negotiationGroup)
            ->withGradUniversity()
            ->save()
            ->get();

        $user = (new UserBuilder())
            ->save()
            ->get();

        $userProfile = (new UserProfileBuilder())
            ->withUser($user)
            ->withLoanType(UserProfile::LOAN_TYPE_UNDERGRADUATE)
            ->withGradUniversity($eligibleProfile->gradUniversity)
            ->save()
            ->get();

        $this->assertNotNull($userProfile->matchingEligibleProfile($negotiationGroup));
    }

    /** @test */
    public function it_should_NOT_be_eligible_if_not_in_valid_university()
    {
        $negotiationGroup = (new NegotiationGroupBuilder())
            ->withPriority(1)
            ->withAcademicYear()
            ->save()
            ->get();

        $eligibleProfile = (new NegotiationGroupEligibilityProfileBuilder())
            ->withNegotiationGroup($negotiationGroup)
            ->withImmigrationStatus(UserProfile::IMMIGRATION_STATUS_US_CITIZEN_OR_PERMANENT_RESIDENT)
            ->withGradDegree()
            ->withGradUniversity()
            ->save()
            ->get();

        $user = (new UserBuilder())
            ->save()
            ->get();

        $userProfile = (new UserProfileBuilder())
            ->withUser($user)
            ->withLoanType(UserProfile::LOAN_TYPE_GRADUATE)
            ->withImmigrationStatus(UserProfile::IMMIGRATION_STATUS_US_CITIZEN_OR_PERMANENT_RESIDENT)
            ->withGradDegree($eligibleProfile->gradDegree)
            ->save()
            ->get();

        $this->assertNull($userProfile->matchingEligibleProfile($negotiationGroup));
    }
}
