<?php


namespace App\Traits;

use App\Experiment;
use App\ExperimentClient;
use App\ExperimentType;

trait ManagesExperimentParticipation
{
    /**
     * @param int $experiment_type_id
     * @return Experiment
     * @throws \Exception
     */
    protected function getOrAssignExperimentOfType(int $experiment_type_id): Experiment
    {
        $experimentType     = ExperimentType::findOrFail($experiment_type_id);
        $assignedExperiment = $this->getAssignedExperimentOfType($experimentType->id);

        if ($assignedExperiment) {
            return $assignedExperiment;
        }

        $experimentsRotation = $experimentType->experiments()->where('active',true)->get()->pluck('id')->toArray();

        $lastExperimentIdInArray = ExperimentClient::whereIn('experiment_id',$experimentsRotation)
            ->orderBy('id','desc')
            ->take(1)
            ->pluck('experiment_id');
        if (count($lastExperimentIdInArray)) {
            $lastExperimentId = $lastExperimentIdInArray[0];
            $indexInRotation  = array_search($lastExperimentId,$experimentsRotation);

            $experimentIndex = $indexInRotation + 1;
            if ($experimentIndex > count($experimentsRotation) - 1) {
                $experimentIndex = 0;
            }
        } else {
            $experimentIndex = 0;
        }
        $experiment_id = $experimentsRotation[$experimentIndex];

        // Assign Client to Experiment
        $experimentClient                = new ExperimentClient();
        $experimentClient->client_id     = getClientId();
        $experimentClient->experiment_id = $experiment_id;
        $experimentClient->save();

        return $experimentClient->experiment;
    }

    /**
     * @param int $experiment_type_id
     * @return Experiment|null
     * @throws \Exception
     */
    protected function getAssignedExperimentOfType(int $experiment_type_id)
    {
        $experimentType = ExperimentType::findOrFail($experiment_type_id);

        $experimentClient = ExperimentClient::where('client_id',getClientId())
            ->whereHas('experiment',function($query) use ($experimentType) {
                $query->where('experiment_type_id',$experimentType->id);
            })
            ->first();

        if ($experimentClient) {
            return $experimentClient->experiment;
        }

        return null;
    }
}
