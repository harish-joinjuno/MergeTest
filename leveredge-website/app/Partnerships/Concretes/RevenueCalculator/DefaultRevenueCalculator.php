<?php


namespace App\Partnerships\Concretes\RevenueCalculator;

use App\AccessTheDeal;

trait DefaultRevenueCalculator
{
    public static function calculateGrossRevenue(AccessTheDeal $accessTheDeal): int
    {
        if (
            $accessTheDeal->deal->percentage_of_loan_amount
            || is_null($accessTheDeal->deal->fee_amount)
        ) {
            return $accessTheDeal->deal->percentage_of_loan_amount/100*$accessTheDeal->loan_amount;
        }

        if (
            is_null($accessTheDeal->deal->percentage_of_loan_amount)
            || $accessTheDeal->deal->fee_amount
        ) {
            return $accessTheDeal->deal->fee_amount;
        }

        throw new \Exception('Do not use Default Revenue Calculator without setting percentage of loan amount or fee amount',500);
    }

    public static function calculateNetRevenue(AccessTheDeal $accessTheDeal): int
    {
        $grossRevenue = $accessTheDeal->gross_revenue;
        if (!$grossRevenue) {
            $grossRevenue = self::calculateGrossRevenue($accessTheDeal);
        }
        $rewardAmount = $accessTheDeal->deal->calculateRewardAmount($accessTheDeal->loan_amount);
        if ($rewardAmount) {
            return $grossRevenue - $rewardAmount;
        }

        return $grossRevenue;
    }
}
