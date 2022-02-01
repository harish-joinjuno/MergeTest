<?php


namespace App\ActionNotifications\Concretes\DisplayNotificationRules;

use App\ActionNotification;
use App\ActionNotifications\Abstracts\AbstractActionNotificationVisibilityRule;
use App\Deal;
use App\DealStatus;
use App\LeveredgeRewardClaim;
use App\User;

class ShouldSubmitLeverEdgeRewardRequestRule extends AbstractActionNotificationVisibilityRule
{
    public static $title = 'Should Submit LeverEdge Reward Claim';

    public static $description = 'The user has a signed loan with a LeverEdge Reward that they haven\'t submitted a claim for';

    public static function passes(User $user, ActionNotification $actionNotification): bool
    {
        $dealIds = Deal::whereNotNull('reward_program')->pluck('id');

        $accessTheDeals = $user->accessTheDeals()
            ->whereIn('deal_id', $dealIds)
            ->where('loan_status_id',DealStatus::SIGNED_THE_LOAN)
            ->get();

        $canDisplay = false;
        foreach ($accessTheDeals as $accessTheDeal) {
            $hasSubmittedClaim = LeveredgeRewardClaim::where('deal_id',$accessTheDeal->deal_id)
                ->where('user_id',$user->id)
                ->exists();
            if (!$hasSubmittedClaim) {
                $canDisplay = true;
            }
        }

        if (!$canDisplay) {
            return false;
        }

        $validRoutes = [
            'member/dashboard',
        ];

        foreach ($validRoutes as $route) {
            if (request()->is($route)) {
                return true;
            }
        }

        return false;
    }
}
