<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class NegotiationGroupAnnouncementPublish extends Action
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public $name = 'Publish';

    public function handle(ActionFields $fields, Collection $models)
    {
        /** @var NegotiationGroupAnnouncement $model */
        foreach ($models as $model) {
            $model->published_body = $model->body;
            $model->save();
        }

        return Action::message('Published !');
    }

    public function fields()
    {
        return [];
    }
}
