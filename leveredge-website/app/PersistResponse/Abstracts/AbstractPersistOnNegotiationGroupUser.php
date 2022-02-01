<?php


namespace App\PersistResponse\Abstracts;


use App\Contracts\HasAcademicYearInterface;
use App\Contracts\PersistResponseInterface;
use App\NegotiationGroupUser;
use App\PersistResponse\PersistInQuestionResponderOnly;
use App\Question;

abstract class AbstractPersistOnNegotiationGroupUser extends PersistInQuestionResponderOnly implements PersistResponseInterface, HasAcademicYearInterface
{

    /**
     * @inheritDoc
     */
    public function persist(Question $question, $needToSaveFromResponder = false)
    {
        parent::persist($question);

        $request    = request();
        $fieldName  = $question->field_name;
        $response   = $request->$fieldName;

        $negotiationGroupUser = $this->getNegotiationGroupUser();

        $negotiationGroupUser->$fieldName = $response;
        $negotiationGroupUser->save();
    }

    public function getPersistedValue(Question $question)
    {
        $fieldName            = $question->field_name;
        $negotiationGroupUser = $this->getNegotiationGroupUser();

        return $negotiationGroupUser->$fieldName;
    }

    protected function getNegotiationGroupUser()
    {
        $academicYear           = $this->getAcademicYear();

        return NegotiationGroupUser::where('user_id',user()->id)
            ->where('academic_year_id',$academicYear->id)
            ->first();
    }
}
