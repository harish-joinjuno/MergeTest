<?php


namespace App\Partnerships\Concretes\MetricsDefinition;


use App\Partnerships\Contracts\MetricsDefinitionInterface;
use App\User;

class ReferredUsers implements MetricsDefinitionInterface
{

    public static function getTitle(): string
    {
        return 'Referred Users';
    }

    public static function getDescription(): string
    {
        return 'LeverEdge Members that were referred by you';
    }

    public static function getValue(User $partner)
    {
        return User::where('referred_by_id',$partner->id)->count();
    }
}
