<?php


namespace App\Partnerships\Concretes\RevenueCalculator;


use App\Partnerships\Contracts\RevenueCalculatorInterface;

class Earnest2019RefinanceDeal implements RevenueCalculatorInterface
{
    use DefaultRevenueCalculator;

    public static function getTitle(): string
    {
        return 'Earnest 2019 Refinance Net Revenue Calculator';
    }

}
