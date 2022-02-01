<?php


namespace App\Partnerships\Concretes\RevenueCalculator;


use App\AccessTheDeal;
use App\Partnerships\Concretes\RevenueCalculator\DefaultRevenueCalculator;
use App\Partnerships\Contracts\RevenueCalculatorInterface;

class SplashRefinanceDeal implements RevenueCalculatorInterface
{
    use DefaultRevenueCalculator;

    public static function getTitle(): string
    {
        return 'Splash Refinance Net Revenue Calculator';
    }

}
