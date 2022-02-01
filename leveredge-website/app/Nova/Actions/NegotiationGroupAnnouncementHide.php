<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class NegotiationGroupAnnouncementHide extends Action
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public $name = 'Hide';

    public function handle(ActionFields $fields, Collection $models)
    {
        /** @var NegotiationGroupAnnouncement $model */
        foreach ($models as $model) {
            $model->published_body = null;
            $model->save();
        }
    }

    public function fields()
    {
        return [];
    }
}
