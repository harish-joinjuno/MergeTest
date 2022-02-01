<?php


namespace App\Repositories;

use App\ExperimentClient;
use App\Repositories\Contracts\ExperimentClientRepositoryInterface;

class ExperimentClientRepository extends Repository implements ExperimentClientRepositoryInterface
{
    protected $model = ExperimentClient::class;

    public function forClientWhereHasExperimentForType(int $typeId)
    {
        return $this->model->where('client_id', getClientId())
            ->whereHas('experiment', function ($query) use ($typeId) {
                $query->where('experiment_type_id', $typeId);
            })
            ->firstOrFail();
    }

    public function lastExperimentFromExperiments(array $experiments): array
    {
        return $this->model
            ->whereIn('experiment_id', $experiments)
            ->orderBy('id', 'desc')
            ->take(1)
            ->pluck('experiment_id')
            ->toArray();
    }

    public function assignToExperimentAsClient(int $experimentId)
    {
        return $this->store([
            'client_id'     => getClientId(),
            'experiment_id' => $experimentId,
        ]);
    }
}
