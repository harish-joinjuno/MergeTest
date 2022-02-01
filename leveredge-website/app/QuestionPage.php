<?php

namespace App;

use App\Contracts\SkipPolicyInterface;
use App\Traits\InteractsWithResponder;
use App\Traits\Slugable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

/**
 * Class QuestionPage
 * @package App
 * @property int $id
 * @property int $sort_order
 * @property string $name
 * @property string $slug
 * @property string $template
 * @property string $skip_policy
 * @property boolean $hide_submission_button
 * @property-read string $url
 * @property int $question_flow_id
 * @property string $pre_render_redirect
 * @property-read string $show_view
 * @property-read string $embed_view
 * @property-read QuestionFlow $questionFlow
 * @property-read Question[]|Collection $questions
 * @property-read Content[]|Collection $contents
 */
class QuestionPage extends Model implements Sortable
{
    use SortableTrait,
        SoftDeletes,
        Slugable,
        InteractsWithResponder;

    public $sortable = [
        'order_column_name'  => 'sort_order',
        'sort_when_creating' => true,
        'sort_on_has_many'   => true,
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('sort_order', 'asc');
        });
    }

    public function buildSortQuery()
    {
        return static::query()->where('question_flow_id', $this->question_flow_id);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function questionFlow()
    {
        return $this->belongsTo(QuestionFlow::class);
    }

    public function shouldSkip()
    {
        if ($this->skip_policy) {
            return (new $this->skip_policy)->check();
        }

        return false;
    }

    public function isFirstPageInFlow()
    {
        return $this->sort_order === 1;
    }

    public function isLastPageInFlow()
    {
        return $this->sort_order === $this->getHighestOrderNumber();
    }

    public function previousPageInFlow()
    {
        return $this->questionFlow->previousPage($this);
    }

    public function nextPageInFlow()
    {
        return $this->questionFlow->nextPage($this);
    }

    public function contents()
    {
        return $this->morphMany(Content::class,'parent');
    }

    public function content()
    {
        return $this->contents->mapWithKeys(function($item) {
            return [$item['name'] => $item['body']];
        });
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function hasQuestionsWithVisibilityPolicy()
    {
        return ($this->questions()->whereNotNull('visibility_policy')->count() > 0);
    }

    public function getTemplateAttribute($template)
    {
        return $template ? $template : $this->questionFlow->template;
    }

    public function getShowViewAttribute()
    {
        return 'question-page.' . $this->template . '.show';
    }

    public function getEmbedViewAttribute()
    {
        return 'question-page.' . $this->template . '.embed';
    }

    public function getUrlAttribute()
    {
        if ($this->questionFlow) {
            return 'question-flow/' . $this->questionFlow->slug . '/' . $this->slug;
        }
    }

    public function getValidationRules()
    {
        $validationRules = [];
        foreach ($this->questions as $question) {
            if ($question->validation_rules && ! $question->shouldSkip()) {
                $validationRules[$question->field_name] = $question->validation_rules;
            }
        }

        return $validationRules;
    }

    public function shouldHideSubmissionButton()
    {
        return $this->hide_submission_button;
    }

    public function questionPageResponders()
    {
        return $this->hasMany(QuestionPageResponder::class, 'question_page_id');
    }

    public function getQuestionPageResponder()
    {
        list($responder_id, $responder_type) = $this->getResponderIdAndType();

        return $this->questionPageResponders()->firstOrCreate([
            'responder_id'   => $responder_id,
            'responder_type' => $responder_type,
        ]);
    }
}
