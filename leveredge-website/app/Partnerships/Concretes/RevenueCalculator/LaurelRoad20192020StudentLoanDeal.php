<?php


namespace App\Partnerships\Concretes\RevenueCalculator;


use App\AccessTheDeal;
use App\Partnerships\Concretes\RevenueCalculator\DefaultRevenueCalculator;
use App\Partnerships\Contracts\RevenueCalculatorInterface;

class LaurelRoad20192020StudentLoanDeal implements RevenueCalculatorInterface
{
    use DefaultRevenueCalculator;

    public static function getTitle(): string
    {
        return 'Laurel Road 2019-2020 Student Loan Net Revenue Calculator';
    }

}
