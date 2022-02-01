<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class NegotiationGroupFaqPublish extends Action
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public $name = 'Publish';

    public function handle(ActionFields $fields, Collection $models)
    {
        /** @var NegotiationGroupFaq $model */
        foreach ($models as $model) {
            $model->published_at   = now();
            $model->published_body = $model->body;
            $model->save();
        }

        return Action::message('Published !');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [];
    }
}
