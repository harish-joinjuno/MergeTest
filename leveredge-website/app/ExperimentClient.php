<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ExperimentClient
 * @package App
 * @property int $id
 * @property int $client_id
 * @property int $experiment_id
 * @property object $properties
 * @property-read Client $client
 * @property-read Experiment $experiment
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class ExperimentClient extends Model
{
    protected $fillable = [
        'client_id',
        'experiment_id',
        'properties',
    ];

    protected $casts = [
        'properties' => 'array',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function experiment()
    {
        return $this->belongsTo(Experiment::class);
    }
}
