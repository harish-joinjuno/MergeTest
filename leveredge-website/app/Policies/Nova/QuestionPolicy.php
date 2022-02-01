<?php


namespace App\Policies\Nova;


use App\Question;

class QuestionPolicy extends AbstractNovaPermissionHandler
{
    public $resource = Question::class;
}
