<?php


namespace App\Traits;


use App\Content;
use App\Question;
use App\QuestionPage;

trait SyncQuestionPageTrait
{
    public function copyQuestionPage($questionPage, $slug, $questionFlowId, $includeQuestionsAndContent = false)
    {
        $newQuestionPage                       = $questionPage->replicate();
        $newQuestionPage->slug                 = $slug;
        $newQuestionPage->question_flow_id     = $questionFlowId;
        $newQuestionPage->save();
        
        if ($includeQuestionsAndContent) {

            /** @var Content $content */
            foreach ($questionPage->contents as $content) {
                $newContent                   = $content->replicate();
                $newContent->parent_id        = $newQuestionPage->id;
                $newContent->parent_type      = QuestionPage::class;
                $newContent->save();
            }

            /** @var Question $question */
            foreach ($questionPage->questions as $question) {
                $newQuestion                   = $question->replicate();
                $newQuestion->question_page_id = $newQuestionPage->id;
                $newQuestion->save();
            }
        }

        return $newQuestionPage;
    }
}
