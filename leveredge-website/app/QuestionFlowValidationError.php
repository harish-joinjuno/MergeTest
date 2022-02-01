<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class QuestionFlowValidationError
 * @package App
 *
 * @property int $id
 * @property int $memberable_id
 * @property string $memberable_type
 *
 * @property int $question_flow_id
 * @property-read QuestionFlow $questionFlow
 *
 * @property int $question_page_id
 * @property-read QuestionPage $questionPage
 *
 * @property array $response
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class QuestionFlowValidationError extends Model
{
    protected $fillable = [
        'memberable_id',
        'memberable_type',
        'question_flow_id',
        'question_page_id',
        'response',
    ];

    protected $casts = [
        'response' => 'array',
    ];

    public function memberable()
    {
        return $this->morphTo();
    }

    public function questionFlow()
    {
        return $this->belongsTo(QuestionFlow::class, 'question_flow_id');
    }

    public function questionPage()
    {
        return $this->belongsTo(QuestionPage::class, 'question_page_id');
    }
}
