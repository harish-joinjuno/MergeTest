<?php


namespace App\Partnerships\Concretes\RevenueCalculator;


use App\AccessTheDeal;
use App\Partnerships\Concretes\RevenueCalculator\DefaultRevenueCalculator;
use App\Partnerships\Contracts\RevenueCalculatorInterface;

class EarnestRefinanceDealWithRewardsInOtherStates implements RevenueCalculatorInterface
{
    use DefaultRevenueCalculator;

    public static function getTitle(): string
    {
        return 'Earnest Refinance Deal With Rewards In Other States Net Revenue Calculator';
    }

}
