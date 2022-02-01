<?php


namespace App\Partnerships\Concretes\RevenueCalculator;

use App\Partnerships\Contracts\RevenueCalculatorInterface;

class AutoPayDeal implements RevenueCalculatorInterface
{
    use DefaultRevenueCalculator;

    public static function getTitle(): string
    {
        return 'Auto Pay Revenue Calculator';
    }

}
