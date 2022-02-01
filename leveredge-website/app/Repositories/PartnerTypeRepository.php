<?php


namespace App\Repositories;


use App\PartnerType;
use App\Repositories\Contracts\PartnerTypeRepositoryInterface;

class PartnerTypeRepository extends Repository implements PartnerTypeRepositoryInterface
{
    protected $model = PartnerType::class;
}
