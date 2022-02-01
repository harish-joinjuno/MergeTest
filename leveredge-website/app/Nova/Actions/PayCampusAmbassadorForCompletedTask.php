<?php

namespace App\Nova\Actions;

use App\CompletedCampusAmbassadorTask;
use App\User;
use DB;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class PayCampusAmbassadorForCompletedTask extends Action
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public $name = 'Pay Ambassador';

    public function handle(ActionFields $fields, Collection $models)
    {
        DB::beginTransaction();

        try {
            /** @var CompletedCampusAmbassadorTask $completedCampusAmbassadorTask */
            foreach ($models as $completedCampusAmbassadorTask) {
                if ($completedCampusAmbassadorTask->payment_completed) {
                    return Action::danger('User has already been paid for this task!');
                }

                /** @var User $payer */
                $payer = auth()->user();

                $completedCampusAmbassadorTask->pay($payer);
                $completedCampusAmbassadorTask->payment_completed = true;
                $completedCampusAmbassadorTask->save();

                $this->markAsFinished($completedCampusAmbassadorTask);
            }

            DB::commit();

            return Action::message('Ambassadors has been paid!');
        } catch (Exception $e) {
            DB::rollback();

            return $this->markAsFailed($completedCampusAmbassadorTask, $e->getMessage());
        }
    }

    public function fields()
    {
        return [];
    }
}
