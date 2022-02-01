<?php


namespace App\Partnerships\Concretes\RevenueCalculator;

use App\Partnerships\Contracts\RevenueCalculatorInterface;

class AutoApproveDeal implements RevenueCalculatorInterface
{
    use DefaultRevenueCalculator;

    public static function getTitle(): string
    {
        return 'Auto Approve Revenue Calculator';
    }

}
