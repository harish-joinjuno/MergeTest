<?php


namespace App\Partnerships\Concretes\RevenueCalculator;


use App\AccessTheDeal;
use App\Partnerships\Concretes\RevenueCalculator\DefaultRevenueCalculator;
use App\Partnerships\Contracts\RevenueCalculatorInterface;

class GBGStudentHealthInsurance implements RevenueCalculatorInterface
{
    use DefaultRevenueCalculator;

    public static function getTitle(): string
    {
        return 'GBG Student Health Insurance Net Revenue Calculator';
    }

}
