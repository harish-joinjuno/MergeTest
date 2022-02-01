<?php

namespace App\Console\Commands;

use App\Jobs\AuthorizationPolicies\UserLoggedInPolicy;
use App\Jobs\CompleteFlow\CreateUserFromPreAuthAutoLoansPartnerRequest;
use App\Jobs\CompleteFlow\CreateUserFromPreAuthInternationalStudentHealthInsurance;
use App\Jobs\CompleteFlow\CreateUserFromPreAuthStudentLoanFlow;
use App\Jobs\CompleteFlow\CreateUserFromPreAuthStudentLoanRefinancingWithIntl;
use App\Jobs\CompleteFlow\CreateUserFromPreAuthTestPrepActAndSat;
use App\Jobs\StartFlow\AddToAutoRefiApplicationIfNotExists;
use App\PersistResponse\PersistOnAutoRefinanceApplication;
use App\PersistResponse\PersistOnAutoRefinanceApplicationOrQuestionResponderIfUserIsNotLoggedIn;
use App\PersistResponse\PersistOnUserModel;
use App\PersistResponse\PersistOnUserModelOrQuestionResponderIfUserIsNotLoggedIn;
use App\PersistResponse\PersistOnUserProfileModel;
use App\PersistResponse\PersistOnUserProfileModelOrQuestionResponderIfUserIsNotLoggedIn;
use App\Question;
use App\QuestionFlow;
use App\QuestionPage;
use App\SkipPolicies\IfSignedIn;
use Illuminate\Console\Command;

class MakeFlowAsPreAuth extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'question-flow:pre-auth';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     s*
     * @return void
     */
    public function handle()
    {
        $maps = [
            '1' => CreateUserFromPreAuthStudentLoanFlow::class,
            '6' => CreateUserFromPreAuthStudentLoanRefinancingWithIntl::class,
            '4' => CreateUserFromPreAuthInternationalStudentHealthInsurance::class,
            '3' => CreateUserFromPreAuthAutoLoansPartnerRequest::class,
        ];

        foreach ($maps as $questionFlowId => $className) {
            $persistMap = [
                PersistOnUserModel::class                => PersistOnUserModelOrQuestionResponderIfUserIsNotLoggedIn::class,
                PersistOnUserProfileModel::class         => PersistOnUserProfileModelOrQuestionResponderIfUserIsNotLoggedIn::class,
                PersistOnAutoRefinanceApplication::class => PersistOnAutoRefinanceApplicationOrQuestionResponderIfUserIsNotLoggedIn::class,
            ];

            /** @var QuestionFlow $questionFlow */
            $questionFlow = QuestionFlow::find($questionFlowId);

            if ($questionFlow->authorization_policy === UserLoggedInPolicy::class) {
                $questionFlow->authorization_policy = null;
            }

            $completeSequence = $questionFlow->complete_sequence;
            if ($questionFlowId === '3') {
                array_unshift($completeSequence, AddToAutoRefiApplicationIfNotExists::class);
            }
            array_unshift($completeSequence, $maps[$questionFlowId]);

            $questionFlow->complete_sequence = $completeSequence;

            $personalInformationQuestionPage = $questionFlow->questionPages()->where('slug', 'LIKE', '%personal-information%')->first();

            if ($questionFlowId === '3') {
                $personalInformationQuestionPage = QuestionPage::find(10);
            }

            if ($personalInformationQuestionPage) {
                $question                   = new Question();
                $question->field_name       = 'email';
                $question->label            = 'Email';
                $question->type             = 'text';
                $question->persist_response = PersistOnUserModelOrQuestionResponderIfUserIsNotLoggedIn::class;
                $question->template         = 'version-1';
                $question->skip_policy      = IfSignedIn::class;
                $question->validation_rules = 'required|email|unique:users';
                $question->question_page_id = $personalInformationQuestionPage->id;
                $question->skip_policy      = IfSignedIn::class;
                $question->save();
            }

            $questionFlow->questionPages->each(function (QuestionPage $questionPage) use ($persistMap) {
                $questionPage->questions->each(function (Question $question) use ($persistMap) {
                    $persistResponse = $question->persist_response;
                    if (isset($persistMap[$persistResponse])) {
                        $question->persist_response = $persistMap[$persistResponse];
                        $question->save();
                    }
                });
            });

            $questionFlow->save();
        }

    }
}
