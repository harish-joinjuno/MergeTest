<?php


namespace App\Partnerships\Contracts;


use App\User;

interface ContractTypeDefinitionInterface
{
    public static function getTitle(): string ;

    public static function calculateEarnedAmount(User $user): int ;
}
