<?php


namespace App\Partnerships\Concretes\RevenueCalculator;


use App\Partnerships\Contracts\RevenueCalculatorInterface;

class EarnestRefinanceDealWithRewards implements RevenueCalculatorInterface
{
    use DefaultRevenueCalculator;

    public static function getTitle(): string
    {
        return 'Earnest Refinance Deal With Rewards Net Revenue Calculator';
    }

}
