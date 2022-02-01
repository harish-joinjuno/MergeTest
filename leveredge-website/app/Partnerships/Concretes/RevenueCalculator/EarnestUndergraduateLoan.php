<?php


namespace App\Partnerships\Concretes\RevenueCalculator;

use App\Partnerships\Contracts\RevenueCalculatorInterface;

class EarnestUndergraduateLoan implements RevenueCalculatorInterface
{
    use DefaultRevenueCalculator;

    public static function getTitle(): string
    {
        return 'Earnest Undergraduate Loan Net Revenue Calculator';
    }

}
