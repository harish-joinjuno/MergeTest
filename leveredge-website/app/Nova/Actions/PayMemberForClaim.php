<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class PayMemberForClaim extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = 'Pay Leveredge Reward';

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
            return Action::danger("Avoid initiating payment for more than 1 user at the time");
        }
        DB::beginTransaction();

        try {
            /**@var Model $model */
            foreach ($models as $model) {

                if ($model->payment_completed) {
                    return Action::danger('User has already been paid for this claim!');
                }

                $model->pay();
            }

            DB::commit();

            return Action::message('User has been paid!');
        } catch (\Exception $e) {
            DB::rollback();

            return Action::danger($e->getMessage());
        }
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
