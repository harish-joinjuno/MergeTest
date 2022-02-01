<?php


namespace App\Partnerships\Contracts;


use App\User;

interface MetricsDefinitionInterface
{
    public static function getTitle(): string ;

    public static function getDescription(): string ;

    public static function getValue(User $user);
}
