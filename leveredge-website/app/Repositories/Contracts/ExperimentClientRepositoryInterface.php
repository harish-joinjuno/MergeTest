<?php


namespace App\Repositories\Contracts;


interface ExperimentClientRepositoryInterface extends RepositoryInterface
{
    /**
     * @param int $typeId
     *
     * @return mixed
     */
    public function forClientWhereHasExperimentForType(int $typeId);

    /**
     * @param array $experiments
     *
     * @return array
     */
    public function lastExperimentFromExperiments(array $experiments): array;

    /**
     * @param int $experimentId
     *
     * @return mixed
     */
    public function assignToExperimentAsClient(int $experimentId);
}
