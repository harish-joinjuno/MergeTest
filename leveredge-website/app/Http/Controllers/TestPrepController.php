<?php

namespace App\Http\Controllers;

use App\Exceptions\QuestionFlowNotStartedException;
use App\Experiment;
use App\ExperimentType;
use App\FaqGroup;
use App\NegotiationGroup;
use App\QuestionFlow;
use App\Traits\ManagesExperimentParticipation;
use Carbon\Carbon;

class TestPrepController extends Controller
{
    use ManagesExperimentParticipation;

    public function collegeTestPrep()
    {
        $experiment = $this->getOrAssignExperimentOfType(ExperimentType::COLLEGE_TEST_PREP_LANDING_PAGE);

        switch ($experiment->id) {

            case Experiment::CTP_LANDING_PAGE_V1:
                return redirect('/test-prep/college-test-prep/v1');

            case Experiment::CTP_LANDING_PAGE_V2:
                return redirect('/test-prep/college-test-prep/v2');

            case Experiment::CTP_LANDING_PAGE_CONTROL:
            default:
                break;
        }

        return view('landing-pages.test-prep.test-prep')->with($this->getDefaultData());
    }

    public function collegeTestPrepPostAuth()
    {
        return view('landing-pages.test-prep.test-prep-post-auth')->with($this->getDefaultData());
    }

    public function bulkBuyV1()
    {
        try {
            $data = $this->getDataForBulkBuyPage();

            return view('landing-pages.test-prep.bulk-buy-v1')->with($data);
        } catch (QuestionFlowNotStartedException $exception) {
            return redirect()->to('/question-flow/' . $exception->getQuestionFlowSlug());
        }
    }

    public function bulkBuyV2()
    {
        try {
            $data = $this->getDataForBulkBuyPage();

            return view('landing-pages.test-prep.bulk-buy-v2')->with($data);
        } catch (QuestionFlowNotStartedException $exception) {
            return redirect()->to('/question-flow/' . $exception->getQuestionFlowSlug());
        }
    }

    public function bulkBuyV3()
    {
        try {
            $data = $this->getDataForBulkBuyPage();

            return view('landing-pages.test-prep.bulk-buy-v3')->with($data);
        } catch (QuestionFlowNotStartedException $exception) {
            return redirect()->to('/question-flow/' . $exception->getQuestionFlowSlug());
        }
    }

    private function getGoals()
    {
        return [
            [
                'min'      => 0,
                'max'      => 49,
                'price'    => 269,
                'discount' => 10,
            ],
            [
                'min'      => 50,
                'max'      => 99,
                'price'    => 239,
                'discount' => 20,
            ],
            [
                'min'      => 100,
                'max'      => 199,
                'price'    => 209,
                'discount' => 30,
            ],
            [
                'min'      => 200,
                'max'      => 299,
                'price'    => 179,
                'discount' => 40,
            ],
            [
                'min'      => 300,
                'max'      => 499,
                'price'    => 150,
                'discount' => 50,
            ],
            [
                'min'      => 500,
                'max'      => 999,
                'price'    => 125,
                'discount' => 58,
            ],
            [
                'min'      => 1000,
                'price'    => 99,
                'discount' => 67,
            ],
        ];
    }

    private function getDataForBulkBuyPage()
    {
        /** @var QuestionFlow $testPrepStandaloneQuestionFlow */
        $testPrepStandaloneQuestionFlow = QuestionFlow::find(QuestionFlow::COLLEGE_TEST_PREP_STANDALONE_ID);

        if (! $testPrepStandaloneQuestionFlow->started()) {
            throw new QuestionFlowNotStartedException($testPrepStandaloneQuestionFlow->slug);
        }
        $data             = $this->getDefaultData();
        $goals            = $this->getGoals();
        $currentGoalIndex = 0;
        foreach ($goals as $index => $goal) {
            $currentGoalIndex = $index;

            if (!empty($goal['max']) && $data['completed_applications'] < $goal['max']) {
                break;
            }
        }

        $data['questionPage']     = $testPrepStandaloneQuestionFlow->getFirstPage();
        $data['currentGoalIndex'] = $currentGoalIndex;
        $data['goals']            = $goals;

        return $data;
    }

    private function getDefaultData()
    {
        $total_applications     = 1000;
        $completed_applications = NegotiationGroup::find(NegotiationGroup::NG_SAT_ACT_PREP_ID)->users_count + 50;
        $progress               = ($completed_applications / $total_applications) * 100;
        $faqs                   = FaqGroup::find(FaqGroup::SAT_ACT_TEST_PREP)->questions;
        $days_to_go             = Carbon::now()->diffInDays('Jan 6, 2021');

        return compact(
            'total_applications',
            'completed_applications',
            'days_to_go',
            'progress',
            'faqs'
        );
    }
}
