<?php


namespace App\Partnerships\Concretes;

use App\Partnerships\Concretes\MetricsDefinition\ClosedLoanAmountByUsersReferredByCampusAmbassadors;
use App\Partnerships\Contracts\ContractTypeDefinitionInterface;
use App\User;

class CampusAmbassadorLead implements ContractTypeDefinitionInterface
{
    public static function getTitle(): string
    {
        return 'Contract for Campus Ambassador Lead (Shehzan)';
    }

    public static function calculateEarnedAmount(User $user): int
    {
        $amountFromAmbassadors = ClosedLoanAmountByUsersReferredByCampusAmbassadors::getValue($user);
        return 0.5/100*$amountFromAmbassadors;
    }
}
