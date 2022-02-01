<?php

namespace App\Nova\Actions;

use App\Scholarship;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class SelectScholarshipWinner extends Action
{
    use InteractsWithQueue, Queueable;

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
            return Action::danger('Please choose winner for one scholarship at a time');
        }

        /** @var Scholarship $scholarship */
        $scholarship = $models->first();
        $entrant     = $scholarship->scholarshipEntrants->random();
        if ($entrant) {
            return Action::redirect("/nova/resources/scholarship-entrants/{$entrant->id}");
        }

        return Action::danger('There are no entrants associated with this scholarship');
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
