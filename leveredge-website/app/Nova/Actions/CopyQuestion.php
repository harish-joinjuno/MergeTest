<?php

namespace App\Nova\Actions;

use App\Question;
use App\QuestionPage;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;

class CopyQuestion extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        /** @var Question $model */
        foreach ($models as $model) {
            $question                   = $model->replicate();
            $question->question_page_id = $fields['question_page_id'];
            $question->save();
        }

        return Action::redirect("/nova/resources/question-pages/{$fields['question_page_id']}");
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Select::make('Question Page', 'question_page_id')
                ->options(QuestionPage::pluck('name', 'id'))
                ->displayUsingLabels()
                ->rules([
                    'required',
                    'exists:question_pages,id',
                ]),
        ];
    }
}
