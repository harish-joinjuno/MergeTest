<?php

namespace App;

use App\Traits\InteractsWithResponder;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class QuestionFlow
 * @package App
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $template
 * @property string $authorization_policy
 * @property array $start_sequence
 * @property array $complete_sequence
 * @property string $after_completion_redirect_to
 * @property int $abandonment_automated_campaign_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read QuestionPage[]|Collection $questionPages
 * @property-read MailchimpAutomatedCampaignMailable $mailable
 */
class QuestionFlow extends Model
{
    use SoftDeletes,
        InteractsWithResponder;

    const STUDENT_LOAN_QUESTION_FLOW_ID                  = 1;
    const STUDENT_LOAN_REFINANCING_FLOW_ID               = 6;
    const AUTO_LOANS_PARTNER_FLOW_ID                     = 3;
    const INTERNATIONAL_STUDENT_HEALTH_INSURANCE_FLOW_ID = 4;
    const BAR_PREP_FLOW_ID                               = 5;
    const COLLEGE_TEST_PREP_ID                           = 7;
    const COLLEGE_TEST_PREP_STANDALONE_ID                = 8;
    const LEAD_NOT_REGISTERED_ID                         = 57;

    protected $fillable = [
        'name',
        'slug',
        'template',
        'authorization_policy',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'start_sequence'    => 'array',
        'complete_sequence' => 'array',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function questionPages()
    {
        return $this->hasMany(QuestionPage::class);
    }

    /**
     * @param QuestionPage $page
     * @return QuestionPage|Model|\Illuminate\Database\Eloquent\Relations\HasMany|object
     */
    public function nextPage(QuestionPage $page)
    {
        return $this->questionPages()
            ->orderBy('sort_order','asc')
            ->where('sort_order', '>', $page->sort_order)
            ->first();
    }

    /**
     * @param QuestionPage $page
     * @return QuestionPage|Model|\Illuminate\Database\Eloquent\Relations\HasMany|object|null
     */
    public function previousPage(QuestionPage $page)
    {
        /** @var QuestionPage $potentialPreviousPage */
        $potentialPreviousPage = $this->questionPages()
            ->orderBy('sort_order','desc')
            ->where('sort_order', '<', $page->sort_order)
            ->first();

        if ($potentialPreviousPage->shouldSkip()) {
            return $this->previousPage($potentialPreviousPage);
        }

        return $potentialPreviousPage;
    }

    public function runStartSequence()
    {
        if ($this->start_sequence) {
            foreach ($this->start_sequence as $job) {
                dispatch((new $job));
            }
        }
    }

    public function runCompleteSequence()
    {
        foreach ($this->complete_sequence as $job) {
            dispatch((new $job));
        }
    }

    public function getRedirectUrl()
    {
        if (class_exists($this->after_completion_redirect_to)) {
            return (new $this->after_completion_redirect_to)->url();
        }
    }

    public function setStartSequenceAttribute($value)
    {
        if ($value === "[]") {
            $this->attributes['start_sequence'] = '[]';
        } else {
            $this->attributes['start_sequence'] = json_encode($value);
        }
    }

    public function setCompleteSequenceAttribute($value)
    {
        if ($value === "[]") {
            $this->attributes['complete_sequence'] = '[]';
        } else {
            $this->attributes['complete_sequence'] = json_encode($value);
        }
    }

    public function getFirstQuestionPageUrl()
    {
        $firstQuestionPageSlug = $this->questionPages()->first()->slug;

        return "/question-flow/{$this->slug}/{$firstQuestionPageSlug}";
    }

    public function getFlowInitUrl()
    {
        return "/question-flow/{$this->slug}";
    }

    public static function getInitUrlForFlow($questionFlowId)
    {
        return static::find($questionFlowId)->getFlowInitUrl();
    }

    public function questionFlowResponders()
    {
        return $this->hasMany(QuestionFlowResponder::class, 'question_flow_id');
    }

    public function started()
    {
        list($responder_id, $responder_type) = $this->getResponderIdAndType();

        return $this->questionFlowResponders()
            ->where('responder_id', $responder_id)
            ->where('responder_type', $responder_type)
            ->whereNotNull('started_at')
            ->whereNull('completed_at')
            ->exists();
    }

    public function getFirstPage()
    {
        return $this->questionPages()->first();
    }

    public function mailable()
    {
        return $this->morphOne(MailchimpAutomatedCampaignMailable::class, 'mailable');
    }
}
