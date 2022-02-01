<?php

namespace App\Nova\Actions;

use App\PageSection;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class PageSectionHide extends Action
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public $name = 'Hide';

    public function handle(ActionFields $fields, Collection $models)
    {
        /** @var PageSection $model */
        foreach ($models as $model) {
            $model->published_at      = null;
            $model->published_content = null;
            $model->save();
        }
    }

    public function fields()
    {
        return [];
    }
}
