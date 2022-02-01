<?php

use App\CampusAmbassadorTask;
use Illuminate\Database\Seeder;

class CampusAmbassadorTaskSeeder extends Seeder
{
    public function run()
    {
        factory(CampusAmbassadorTask::class)->create([
            'task_recurrence'          => CampusAmbassadorTask::TASK_RECURRENCE_NONE,
            'task_completion_tracking' => CampusAmbassadorTask::TASK_COMPLETION_TRACKING_AUTOMATIC,
            'payment_type'             => CampusAmbassadorTask::PAYMENT_TYPE_HOURLY,
        ]);

        factory(CampusAmbassadorTask::class)->create([
            'task_recurrence'          => CampusAmbassadorTask::TASK_RECURRENCE_RECURRING,
            'task_completion_tracking' => CampusAmbassadorTask::TASK_COMPLETION_TRACKING_AUTOMATIC,
            'payment_type'             => CampusAmbassadorTask::PAYMENT_TYPE_HOURLY,
        ]);

        factory(CampusAmbassadorTask::class)->create([
            'task_recurrence'          => CampusAmbassadorTask::TASK_RECURRENCE_NONE,
            'task_completion_tracking' => CampusAmbassadorTask::TASK_COMPLETION_TRACKING_MANUAL,
            'payment_type'             => CampusAmbassadorTask::PAYMENT_TYPE_HOURLY,
        ]);

        factory(CampusAmbassadorTask::class)->create([
            'task_recurrence'          => CampusAmbassadorTask::TASK_RECURRENCE_RECURRING,
            'task_completion_tracking' => CampusAmbassadorTask::TASK_COMPLETION_TRACKING_MANUAL,
            'payment_type'             => CampusAmbassadorTask::PAYMENT_TYPE_HOURLY,
        ]);

        factory(CampusAmbassadorTask::class)->create([
            'task_recurrence'          => CampusAmbassadorTask::TASK_RECURRENCE_RECURRING,
            'task_completion_tracking' => CampusAmbassadorTask::TASK_COMPLETION_TRACKING_MANUAL,
            'payment_type'             => CampusAmbassadorTask::PAYMENT_TYPE_FIXED,
        ]);

        factory(CampusAmbassadorTask::class)->create([
            'task_recurrence'          => CampusAmbassadorTask::TASK_RECURRENCE_NONE,
            'task_completion_tracking' => CampusAmbassadorTask::TASK_COMPLETION_TRACKING_MANUAL,
            'payment_type'             => CampusAmbassadorTask::PAYMENT_TYPE_FIXED,
        ]);

        factory(CampusAmbassadorTask::class)->create([
            'task_recurrence'          => CampusAmbassadorTask::TASK_RECURRENCE_NONE,
            'task_completion_tracking' => CampusAmbassadorTask::TASK_COMPLETION_TRACKING_AUTOMATIC,
            'payment_type'             => CampusAmbassadorTask::PAYMENT_TYPE_FIXED,
        ]);
    }
}
