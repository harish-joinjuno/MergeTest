<?php


namespace App\Partnerships\Concretes\RevenueCalculator;

use App\Partnerships\Contracts\RevenueCalculatorInterface;

class CredibleRefinanceDeal implements RevenueCalculatorInterface
{
    use DefaultRevenueCalculator;

    public static function getTitle(): string
    {
        return 'Credible Refinance Net Revenue Calculator';
    }

}
