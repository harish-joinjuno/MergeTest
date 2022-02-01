<?php


namespace App\Repositories;


use App\ContractType;
use App\Repositories\Contracts\ContractTypeRepositoryInterface;

class ContractTypeRepository extends Repository implements ContractTypeRepositoryInterface
{
    protected $model = ContractType::class;
}
