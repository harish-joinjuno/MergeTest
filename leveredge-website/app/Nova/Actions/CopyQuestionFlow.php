<?php

namespace App\Nova\Actions;

use App\QuestionFlow;
use App\Traits\SyncQuestionPageTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Text;

class CopyQuestionFlow extends Action
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
            return Action::danger('Please copy 1 question flow at a time');
        }

        /** @var QuestionFlow $questionFlow */
        $questionFlow          = $models->first();
        $newQuestionFlow       = $questionFlow->replicate();
        $newQuestionFlow->name = "{$questionFlow->name} (Copy)";
        $newQuestionFlow->slug = $fields['slug'];
        $newQuestionFlow->save();

        if ($fields['include_all_relations']) {
            foreach ($questionFlow->questionPages as $questionPage) {
                $this->copyQuestionPage($questionPage, "{$questionPage->slug}-copy", $newQuestionFlow->id, $fields['include_all_relations']);
            }
        }

        return Action::redirect("/nova/resources/question-flows/{$newQuestionFlow->id}");
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
                'unique:question_flows,slug',
            ]),
            Boolean::make('Include  Question Pages, Questions and Content', 'include_all_relations'),
        ];
    }
}
