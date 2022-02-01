<?php


namespace App\Partnerships\Concretes\RevenueCalculator;

use App\Partnerships\Contracts\RevenueCalculatorInterface;

class CommonBondMBA2021 implements RevenueCalculatorInterface
{
    use DefaultRevenueCalculator;

    public static function getTitle(): string
    {
        return 'CommonBond MBA 2021 Net Revenue Calculator';
    }

}
