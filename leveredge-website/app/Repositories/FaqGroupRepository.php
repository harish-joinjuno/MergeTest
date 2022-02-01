<?php


namespace App\Repositories;


use App\FaqGroup;
use App\Repositories\Contracts\FaqGroupRepositoryInterface;

class FaqGroupRepository extends Repository implements FaqGroupRepositoryInterface
{
    protected $model = FaqGroup::class;
}
