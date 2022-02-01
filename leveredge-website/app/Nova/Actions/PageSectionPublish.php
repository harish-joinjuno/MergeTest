<?php

namespace App\Nova\Actions;

use App\PageSection;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class PageSectionPublish extends Action
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public $name = 'Publish';

    public function handle(ActionFields $fields, Collection $models)
    {
        /** @var PageSection $model */
        foreach ($models as $model) {
            $model->published_at      = now();
            $model->published_content = $model->working_content;
            $model->save();
        }

        return Action::message('Published !');
    }

    public function fields()
    {
        return [];
    }
}
