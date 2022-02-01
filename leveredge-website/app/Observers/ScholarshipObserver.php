<?php

namespace App\Observers;

use App\Scholarship;
use App\ScholarshipQuestion;

class ScholarshipObserver
{
    /**
     * Handle the scholarship "created" event.
     *
     * @param  \App\Scholarship  $scholarship
     * @return void
     */
    public function created(Scholarship $scholarship)
    {
        // Add Default Questions
        $firstNameQuestion                   = new ScholarshipQuestion();
        $firstNameQuestion->scholarship_id   = $scholarship->id;
        $firstNameQuestion->field_name       = "first_name";
        $firstNameQuestion->label            = 'What is your first name?';
        $firstNameQuestion->type             = 'first-name';
        $firstNameQuestion->validation_rules = 'required';
        $firstNameQuestion->save();

        $firstNameQuestion                   = new ScholarshipQuestion();
        $firstNameQuestion->scholarship_id   = $scholarship->id;
        $firstNameQuestion->field_name       = "last_name";
        $firstNameQuestion->label            = 'What is your last name?';
        $firstNameQuestion->type             = 'last-name';
        $firstNameQuestion->validation_rules = 'required';
        $firstNameQuestion->save();

        $firstNameQuestion                   = new ScholarshipQuestion();
        $firstNameQuestion->scholarship_id   = $scholarship->id;
        $firstNameQuestion->field_name       = "email";
        $firstNameQuestion->label            = 'What is your email address?';
        $firstNameQuestion->type             = 'email';
        $firstNameQuestion->validation_rules = 'required|email';
        $firstNameQuestion->save();
    }

    /**
     * Handle the scholarship "updated" event.
     *
     * @param  \App\Scholarship  $scholarship
     * @return void
     */
    public function updated(Scholarship $scholarship)
    {
        //
    }

    /**
     * Handle the scholarship "deleted" event.
     *
     * @param  \App\Scholarship  $scholarship
     * @return void
     */
    public function deleted(Scholarship $scholarship)
    {
        //
    }

    /**
     * Handle the scholarship "restored" event.
     *
     * @param  \App\Scholarship  $scholarship
     * @return void
     */
    public function restored(Scholarship $scholarship)
    {
        //
    }

    /**
     * Handle the scholarship "force deleted" event.
     *
     * @param  \App\Scholarship  $scholarship
     * @return void
     */
    public function forceDeleted(Scholarship $scholarship)
    {
        //
    }
}
