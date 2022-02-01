<?php


namespace App\Policies\Nova;


use App\QuestionPage;

class QuestionPagePolicy extends AbstractNovaPermissionHandler
{
    public $resource = QuestionPage::class;
}
