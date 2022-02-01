<?php


namespace App\Repositories\Contracts;


interface ExperimentTypeRepositoryInterface extends RepositoryInterface
{
    /**
     * @param int $experimentTypeId
     *
     * @return array
     */
    public function pluckWithActiveExperiments(int $experimentTypeId): array;
}
