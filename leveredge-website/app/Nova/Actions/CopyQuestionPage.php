<?php

namespace App\Nova\Actions;

use App\Content;
use App\Question;
use App\QuestionFlow;
use App\QuestionPage;
use App\Traits\SyncQuestionPageTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;

class CopyQuestionPage extends Action
{
    use InteractsWithQueue, Queueable, SyncQuestionPageTrait;

    public $onlyOnDetail = true;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        if ($models->count() > 1) {
            return Action::danger('Please copy 1 question page at a time');
        }

        /** @var QuestionPage $questionPage */
        $questionPage    = $models->first();
        $newQuestionPage = $this->copyQuestionPage($questionPage, $fields['slug'], $fields['question_flow_id'], true);

        return Action::redirect("/nova/resources/question-pages/{$newQuestionPage->id}");
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Text::make('Slug')->rules([
                'required',
                'unique:question_pages,slug',
            ]),
            Select::make('Question Flow', 'question_flow_id')
                ->options(QuestionFlow::pluck('name', 'id'))
                ->displayUsingLabels()
                ->rules([
                    'required',
                    'exists:question_flows,id',
                ]),
            Boolean::make('Include  Questions and Content', 'include_questions_and_content'),
        ];
    }
}
