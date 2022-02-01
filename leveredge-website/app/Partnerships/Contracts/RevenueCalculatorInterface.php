<?php


namespace App\Partnerships\Contracts;

use App\AccessTheDeal;

interface RevenueCalculatorInterface
{
    public static function getTitle(): string;

    public static function calculateNetRevenue(AccessTheDeal $accessTheDeal): int ;

    public static function calculateGrossRevenue(AccessTheDeal $accessTheDeal): int ;
}
