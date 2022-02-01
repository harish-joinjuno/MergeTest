<?php


namespace App\Contracts;

use App\Question;

interface PersistResponseInterface
{
    /**
     * @param Question $question
     * @param bool $needToSaveFromResponder
     * @return null
     */
    public function persist(Question $question, $needToSaveFromResponder = false);

    /**
     * @param Question $question
     * @return mixed
     */
    public function getPersistedValue(Question $question);

    /**
     * @param string $fieldName
     * @return mixed
     */
    public function acceptsFieldName(string $fieldName);
}
