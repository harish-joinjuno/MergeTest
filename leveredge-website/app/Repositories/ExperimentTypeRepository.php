<?php


namespace App\Repositories;


use App\ExperimentType;
use App\Repositories\Contracts\ExperimentTypeRepositoryInterface;

class ExperimentTypeRepository extends Repository implements ExperimentTypeRepositoryInterface
{
    protected $model = ExperimentType::class;

    public function pluckWithActiveExperiments(int $experimentTypeId): array
    {
        return $this->find($experimentTypeId)
            ->experiments()
            ->where('active', true)
            ->get()
            ->pluck('id')
            ->toArray();
    }
}
