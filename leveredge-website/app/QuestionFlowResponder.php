<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $question_flow_id
 * @property int $responder_id
 * @property string $responder_type
 * @property Carbon $started_at
 * @property Carbon $completed_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read QuestionFlow $questionFlow
 */
class QuestionFlowResponder extends Model
{
    protected $fillable = [
        'question_flow_id',
        'responder_id',
        'responder_type',
        'started_at',
        'completed_at',
    ];

    protected $dates = [
        'started_at',
        'completed_at',
    ];

    public function questionFlow()
    {
        return $this->belongsTo(QuestionFlow::class, 'question_flow_id');
    }

    public function responder()
    {
        return $this->morphTo();
    }
}
