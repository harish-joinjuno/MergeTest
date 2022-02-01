<?php


namespace App\Contracts;

use App\Question;
use App\User;

interface QuestionOptionInterface
{
    /**
     * @return array
     */
    public function options();

}
