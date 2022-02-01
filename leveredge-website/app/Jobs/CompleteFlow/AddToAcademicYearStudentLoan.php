<?php


namespace App\Jobs\CompleteFlow;

use App\AcademicYear;
use App\Exceptions\AuthPersistException;
use App\NegotiationGroupUser;
use App\Question;

class AddToAcademicYearStudentLoan extends Abstracts\AddToAcademicYear
{
    protected function getAcademicYear()
    {
        /** @var Question $question */
        $question             = Question::find(Question::STUDENT_LOAN_ACADEMIC_YEAR_QUESTION_ID);
        $targetAcademicYearId = $question->getPersistedResponse();

        if (empty($targetAcademicYearId)) {
            $responder = app('client_question_responders')->where('question_id', $question->id)->first();

            if ($responder) {
                $targetAcademicYearId = $responder->response;
            }
        }

        if (empty($targetAcademicYearId)) {
            /** @noinspection PhpUnhandledExceptionInspection */
            throw new \Exception('User does not have a target academic year id');
        }

        return AcademicYear::find($targetAcademicYearId);
    }

    protected function addLoanAmountToNegotiationGroupUser()
    {
        $negotiationGroupUser = NegotiationGroupUser::where('user_id', $this->user->id)->orderBy('created_at', 'DESC')->first();

        if ($negotiationGroupUser) {
            $loanAmountQuestion = app('client_question_responders')->whereIn('question_id', [Question::STUDENT_LOAN_LOAN_AMOUNT_QUESTION_ID])->first();

            if ($loanAmountQuestion) {

                $negotiationGroupUser->amount = $loanAmountQuestion->response;
                $negotiationGroupUser->save();
            }
        }
    }
}
