<?php


namespace Tests\Feature\ActionNotificationVisibilityRules;


use App\ActionNotifications\Concretes\DisplayNotificationRules\ShouldSubmitLeverEdgeRewardRequestRule;
use App\Deal;
use App\DealStatus;
use App\Degree;
use App\UserProfile;
use Tests\Builders\AccessTheDealBuilder;
use Tests\Builders\ActionNotificationBuilder;
use Tests\Builders\LeverEdgeRewardClaimBuilder;
use Tests\Builders\UserBuilder;
use Tests\Builders\UserProfileBuilder;
use Tests\TestCase;

class ShouldSubmitLeverEdgeRewardRequestRuleTest extends TestCase
{
    public function test_it_should_be_visible_once_loan_is_signed()
    {


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

        $actionNotification = (new ActionNotificationBuilder())
            ->withTitle()
            ->withDescription()
            ->withCtaLink()
            ->withCtaLink()
            ->withIcon()
            ->withNotificationStyle()
            ->withVisibilityRule('App\ActionNotifications\Concretes\DisplayNotificationRules\ShouldSubmitLeverEdgeRewardRequestRule')
            ->withDismissableRule()
            ->save()
            ->get();

        $this->get('/member/dashboard');

        // It should be false when there is no access the deal
        $this->assertFalse(ShouldSubmitLeverEdgeRewardRequestRule::passes($user,$actionNotification));

        // It should be false when there is access the deal without a reward program
        $accessTheDeal = (new AccessTheDealBuilder())
            ->withUser($user)
            ->withDeal(Deal::whereNull('reward_program')->inRandomOrder()->first())
            ->withLoanStatus(DealStatus::where('id',DealStatus::SIGNED_THE_LOAN)->first())
            ->save()
            ->get();

        $this->assertFalse(ShouldSubmitLeverEdgeRewardRequestRule::passes($user,$actionNotification));

        // It should be false when the loan status is not signed yet
        $accessTheDeal = (new AccessTheDealBuilder())
            ->withUser($user)
            ->withDeal(Deal::whereNotNull('reward_program')->inRandomOrder()->first())
            ->withLoanStatus(DealStatus::where('id',DealStatus::RECEIVED_PRELIMINARY_QUOTES_ID)->first())
            ->save()
            ->get();

        $this->assertFalse(ShouldSubmitLeverEdgeRewardRequestRule::passes($user,$actionNotification));

        // It should be true when the loan status is signed
        $accessTheDeal = (new AccessTheDealBuilder())
            ->withUser($user)
            ->withDeal(Deal::whereNotNull('reward_program')->inRandomOrder()->first())
            ->withLoanStatus(DealStatus::where('id',DealStatus::SIGNED_THE_LOAN)->first())
            ->save()
            ->get();

        $this->assertTrue( ShouldSubmitLeverEdgeRewardRequestRule::passes($user, $actionNotification));

        // It should become false once a claim if filed associated with that deal
        $leveredgeRewardClaim = (new LeverEdgeRewardClaimBuilder())
            ->withDeal($accessTheDeal->deal)
            ->withUser($user)
            ->withLoanAmount()
            ->withPaymentMethod()
            ->withRewardAmount()
            ->save()
            ->get();

        $this->assertFalse( ShouldSubmitLeverEdgeRewardRequestRule::passes($user, $actionNotification));

    }

    public function test_it_should_not_be_visible_on_other_routes()
    {


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

        $actionNotification = (new ActionNotificationBuilder())
            ->withTitle()
            ->withDescription()
            ->withCtaLink()
            ->withCtaLink()
            ->withIcon()
            ->withNotificationStyle()
            ->withVisibilityRule('App\ActionNotifications\Concretes\DisplayNotificationRules\ShouldSubmitLeverEdgeRewardRequestRule')
            ->withDismissableRule()
            ->save()
            ->get();

        $this->get('/');

        // It should be false when there is no access the deal
        $this->assertFalse(ShouldSubmitLeverEdgeRewardRequestRule::passes($user,$actionNotification));

        // It should be false when there is access the deal without a reward program
        $accessTheDeal = (new AccessTheDealBuilder())
            ->withUser($user)
            ->withDeal(Deal::whereNull('reward_program')->inRandomOrder()->first())
            ->withLoanStatus(DealStatus::where('id',DealStatus::SIGNED_THE_LOAN)->first())
            ->save()
            ->get();

        $this->assertFalse(ShouldSubmitLeverEdgeRewardRequestRule::passes($user,$actionNotification));

        // It should be false when the loan status is not signed yet
        $accessTheDeal = (new AccessTheDealBuilder())
            ->withUser($user)
            ->withDeal(Deal::whereNotNull('reward_program')->inRandomOrder()->first())
            ->withLoanStatus(DealStatus::where('id',DealStatus::RECEIVED_PRELIMINARY_QUOTES_ID)->first())
            ->save()
            ->get();

        $this->assertFalse(ShouldSubmitLeverEdgeRewardRequestRule::passes($user,$actionNotification));

        // It should be true when the loan status is signed
        $accessTheDeal = (new AccessTheDealBuilder())
            ->withUser($user)
            ->withDeal(Deal::whereNotNull('reward_program')->inRandomOrder()->first())
            ->withLoanStatus(DealStatus::where('id',DealStatus::SIGNED_THE_LOAN)->first())
            ->save()
            ->get();

        $this->assertFalse( ShouldSubmitLeverEdgeRewardRequestRule::passes($user, $actionNotification));

        // It should become false once a claim if filed associated with that deal
        $leveredgeRewardClaim = (new LeverEdgeRewardClaimBuilder())
            ->withDeal($accessTheDeal->deal)
            ->withUser($user)
            ->withLoanAmount()
            ->withPaymentMethod()
            ->withRewardAmount()
            ->save()
            ->get();

        $this->assertFalse( ShouldSubmitLeverEdgeRewardRequestRule::passes($user, $actionNotification));

    }
}
