<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\QuestionFlow;

class AddRedirectChangesToQuestionFlows extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('question_flows', function (Blueprint $table) {
            $questionFlow = QuestionFlow::whereSlug('student-loan')->first();
            if ($questionFlow) {
                $questionFlow->after_completion_redirect_to = \App\Redirects\RedirectToUserProfileEndScreen::class;
                $questionFlow->save();
            }

            $questionFlow = QuestionFlow::whereSlug('international-student-health-insurance')->first();
            if ($questionFlow) {
                $questionFlow->after_completion_redirect_to = \App\Redirects\RedirectToUserProfileEndScreen::class;
                $questionFlow->save();
            }

            $questionFlow = QuestionFlow::whereSlug('bar-prep')->first();
            if ($questionFlow) {
                $questionFlow->after_completion_redirect_to = \App\Redirects\RedirectToUserProfileEndScreen::class;
                $questionFlow->save();
            }

            $questionFlow = QuestionFlow::whereSlug('student-loan-refinancing')->first();
            if ($questionFlow) {
                $questionFlow->after_completion_redirect_to = \App\Redirects\RedirectToRefinanceEndScreen::class;
                $questionFlow->save();
            }

            $questionFlow = QuestionFlow::whereSlug('auto-loans-partner')->first();
            if ($questionFlow) {
                $questionFlow->after_completion_redirect_to = \App\Redirects\RedirectToAutoLoansPostAuthPage::class;
                $questionFlow->save();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('question_flows', function (Blueprint $table) {
            //
        });
    }
}
