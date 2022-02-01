<?php


namespace App\Partnerships\Concretes\RevenueCalculator;


use App\AccessTheDeal;
use App\Partnerships\Concretes\RevenueCalculator\DefaultRevenueCalculator;
use App\Partnerships\Contracts\RevenueCalculatorInterface;

class FirstRepublicPersonalLineOfCredit implements RevenueCalculatorInterface
{
    use DefaultRevenueCalculator;

    public static function getTitle(): string
    {
        return 'First Republic Personal Line Of Credit Net Revenue Calculator';
    }

}
