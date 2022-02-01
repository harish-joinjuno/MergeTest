<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $contract_type_id
 * @property-read ContractType $contractType
 * @property int $metric_id
 * @property-read Metric $metric
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class ContractTypeMetric extends Model
{
    public function contractType()
    {
        return $this->belongsTo(ContractType::class, 'contract_type_id');
    }

    public function metric()
    {
        return $this->belongsTo(Metric::class, 'metric_id');
    }
}
