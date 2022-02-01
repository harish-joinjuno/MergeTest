<?php


namespace App\Partnerships\Concretes\RevenueCalculator;


use App\Partnerships\Contracts\RevenueCalculatorInterface;

class EarnestLongTermRefinanceDeal implements RevenueCalculatorInterface
{
    use DefaultRevenueCalculator;

    public static function getTitle(): string
    {
        return 'Earnest Long Term Refinance Net Revenue Calculator';
    }

}
