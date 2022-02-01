<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class QuestionResponder
 * @package App
 * @property int $id
 * @property int $responder_id
 * @property string $responder_type
 * @property int $question_id
 * @property string $response
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class QuestionResponder extends Model
{
    public function responder()
    {
        return $this->morphTo();
    }
}
