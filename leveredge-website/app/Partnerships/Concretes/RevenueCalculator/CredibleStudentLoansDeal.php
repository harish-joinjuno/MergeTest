<?php


namespace App\Partnerships\Concretes\RevenueCalculator;


use App\Partnerships\Contracts\RevenueCalculatorInterface;

class CredibleStudentLoansDeal implements RevenueCalculatorInterface
{
    use DefaultRevenueCalculator;

    public static function getTitle(): string
    {
        return 'Credible Student Loan Net Revenue Calculator';
    }

}
