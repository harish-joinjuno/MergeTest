<?php

namespace App;

use App\Contracts\PersistResponseInterface;
use App\Contracts\QuestionOptionInterface;
use App\Contracts\VisibilityPolicyInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

/**
 * Class Question
 * @package App
 * @property int $id
 * @property int $question_page_id
 * @property int $sort_order
 * @property string $template
 * @property-read string $show_view
 * @property string $type
 * @property string $label
 * @property string $helper_text
 * @property string $placeholder
 * @property string $field_name
 * @property string $validation_rules
 * @property string $skip_policy
 * @property string $visibility_policy
 * @property string $persist_response
 * @property string $question_option
 * @property string $tooltip
 * @property-read array $options
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read QuestionPage $questionPage
 */
class Question extends Model implements Sortable
{
    use SortableTrait,
        SoftDeletes;

    const STUDENT_LOAN_ACADEMIC_YEAR_QUESTION_ID = 2;

    const STUDENT_LOAN_LOAN_AMOUNT_QUESTION_ID = 174;

    const IMMIGRATION_QUESTION_IDS = [6, 25, 66, 101];

    const GRADUATE_QUESTION_ID = 116;

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
        return static::query()->where('question_page_id', $this->question_page_id);
    }

    public function questionPage()
    {
        return $this->belongsTo(QuestionPage::class);
    }

    public function getTemplateAttribute($template)
    {
        return $template ? $template : $this->questionPage->template;
    }

    public function getShowViewAttribute()
    {
        return 'question.' . $this->template . '.' . $this->type;
    }

    /**
     * @return bool
     * This page determines if the question should be skipped
     */
    public function shouldSkip()
    {
        if ($this->skip_policy) {
            return (new $this->skip_policy)->check();
        }

        return false;
    }

    /**
     * This method provides the definition that is used by the front end (javascript)
     * to set the visibility of the question as the user interacts with the page
     */
    public function getVisibilityPolicyDefinition()
    {
        if ($this->visibility_policy) {
            /** @var VisibilityPolicyInterface $visibilityPolicy */
            $visibilityPolicy = (new $this->visibility_policy);

            return $visibilityPolicy->getDefinition();
        }

        return null;
    }

    /**
     * @param bool $needToSaveFromResponder
     * @return null
     * @throws \Exception This method is responsible to store the response to the question in the database
     */
    public function persistResponse($needToSaveFromResponder = false)
    {
        if ($this->persist_response) {
            /** @var PersistResponseInterface $persistResponseClass */
            $persistResponseClass = (new $this->persist_response);

            return $persistResponseClass->persist($this, $needToSaveFromResponder);
        }

        throw new \Exception('Question does not have a valid method to persist the response');
    }

    public function getPersistedResponse()
    {
        if ($this->persist_response) {
            /** @var PersistResponseInterface $persistResponseClass */
            $persistResponseClass = (new $this->persist_response);

            return $persistResponseClass->getPersistedValue($this);
        }
    }

    public function getPrefillValue()
    {
        $recentInput = old($this->field_name);
        if (! is_null($recentInput)) {
            return $recentInput;
        }

        return $this->getPersistedResponse();
    }

    public function isRequired()
    {
        return strpos($this->validation_rules,'required') !== false;
    }

    public function isFirstOnPage()
    {
        return $this->sort_order === 1;
    }

    public function isLastOnPage()
    {
        return $this->sort_order === $this->getHighestOrderNumber();
    }

    public function getOptionsAttribute()
    {
        /** @var QuestionOptionInterface $question_option */
        $question_option = (new $this->question_option);

        return $question_option->options();
    }

    public function questionResponders()
    {
        return $this->hasMany(QuestionResponder::class, 'question_id');
    }
}
