<?php


namespace App\Partnerships\Concretes\RevenueCalculator;


use App\Partnerships\Concretes\RevenueCalculator\DefaultRevenueCalculator;
use App\Partnerships\Contracts\RevenueCalculatorInterface;

class LaurelRoadRefinanceDeal implements RevenueCalculatorInterface
{
    use DefaultRevenueCalculator;

    public static function getTitle(): string
    {
        return 'Laurel Road Refinance Net Revenue Calculator';
    }

}
