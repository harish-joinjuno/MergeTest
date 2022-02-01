<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $question_page_id
 * @property int $responder_id
 * @property string $responder_type
 * @property Carbon $shown_at
 * @property Carbon $posted_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read QuestionPage[] $questionPages
 * @property-read QuestionPageResponder $responder
 */
class QuestionPageResponder extends Model
{
    protected $fillable = [
        'question_page_id',
        'responder_id',
        'responder_type',
        'shown_at',
        'posted_at',
    ];

    protected $dates = [
        'shown_at',
        'posted_at',
    ];

    public function questionPage()
    {
        return $this->belongsTo(QuestionPage::class, 'question_page_id');
    }

    public function responder()
    {
        return $this->morphTo();
    }

    public function setShownAt()
    {
        $this->shown_at = now();
        $this->save();
    }

    public function setPostedAt()
    {
        $this->posted_at = now();
        $this->save();
    }
}
