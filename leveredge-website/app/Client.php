<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class Client
 * @package App
 * @property int $id
 * @property-read Collection $clientRequests
 * @property-read UserClient $userClient
 * @property-read Collection $experimentClients
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Client extends Model
{
    public function clientRequests()
    {
        return $this->hasMany(ClientRequest::class);
    }

    public function userClient()
    {
        return $this->hasOne(UserClient::class);
    }

    public function experimentClients()
    {
        return $this->hasMany(ExperimentClient::class);
    }

    public function isPartOfExperiment(Experiment $experiment)
    {
        if ($this->userClient) {
            $relatedClientIds = UserClient::where('user_id',$this->userClient->user_id)
                ->pluck('client_id');

            return ExperimentClient::whereIn('client_id',$relatedClientIds)
                ->where('experiment_id',$experiment->id)
                ->exists();
        }

        return ExperimentClient::where('client_id',$this->id)
                ->where('experiment_id',$experiment->id)
                ->exists();
    }

    public function isPartOfExperiments(Collection $experiments)
    {
        if ($this->userClient) {
            $relatedClientIds = UserClient::where('user_id',$this->userClient->user_id)
                ->pluck('client_id');

            return ExperimentClient::whereIn('client_id',$relatedClientIds)
                ->whereIn('experiment_id',$experiments->pluck('id'))
                ->exists();
        }

        return ExperimentClient::where('client_id',$this->id)
            ->whereIn('experiment_id',$experiments->pluck('id'))
            ->exists();
    }

    public function clientEvents()
    {
        return $this->hasMany(ClientEvent::class, 'client_id');
    }

    public function questionFlowValidationErrors()
    {
        return $this->morphMany(QuestionFlowValidationError::class, 'memberable');
    }

    public function questionResponder()
    {
        return $this->morphMany(QuestionResponder::class, 'responder');
    }
}
