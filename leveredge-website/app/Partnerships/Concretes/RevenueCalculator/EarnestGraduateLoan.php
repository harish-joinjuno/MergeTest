<?php


namespace App\Partnerships\Concretes\RevenueCalculator;


use App\Partnerships\Contracts\RevenueCalculatorInterface;

class EarnestGraduateLoan implements RevenueCalculatorInterface
{
    use DefaultRevenueCalculator;

    public static function getTitle(): string
    {
        return 'Earnest Graduate Net Revenue Calculator';
    }

}
