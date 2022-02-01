<?php


namespace App\Partnerships\Concretes;


use App\Partnerships\Contracts\ContractTypeDefinitionInterface;
use App\User;

class Free implements ContractTypeDefinitionInterface
{

    public static function getTitle(): string
    {
        return 'No payment';
    }

    public static function calculateEarnedAmount(User $partner): int
    {
        return 0;
    }
}
