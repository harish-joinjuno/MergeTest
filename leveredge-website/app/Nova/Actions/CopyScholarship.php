<?php

namespace App\Nova\Actions;

use App\Scholarship;
use App\ScholarshipContent;
use App\ScholarshipEmail;
use App\ScholarshipEntrant;
use App\ScholarshipWinner;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Text;

class CopyScholarship extends Action
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
        if ($models->count() > 1) {
            return Action::danger('Please copy 1 scholarship at a time');
        }

        /** @var Scholarship $model */
        foreach ($models as $model) {
            $scholarship       = $model->replicate();
            $scholarship->name = $fields['name'];
            $scholarship->slug = Str::slug($scholarship->name);
            $scholarship->save();

            $relations = [
                'scholarshipQuestions',
                'scholarshipWinners',
                'scholarshipContents',
                'scholarshipEmails',
            ];

            foreach ($relations as $relation) {
                foreach ($model->$relation as $question) {

                    if (isset($question->field_name) && in_array($question->field_name,['first_name','last_name','email'])  ) {
                        continue;
                    }
                    
                    $new_question                 = $question->replicate();
                    $new_question->scholarship_id = $scholarship->id;
                    $new_question->save();
                }
            }
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Text::make('Name')->rules(['required']),
        ];
    }
}
