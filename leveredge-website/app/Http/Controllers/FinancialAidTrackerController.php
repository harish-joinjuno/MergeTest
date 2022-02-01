<?php

namespace App\Http\Controllers;

use App\FinancialAidTracker;
use App\FinancialAidTrackerEligibleProgram;
use App\Http\Requests\FinancialAidTrackerRequest;
use App\University;
use Illuminate\Http\Request;

class FinancialAidTrackerController extends Controller
{
    protected $dataPoints   = [];
    protected $programNames = [];
    protected $medians      = [];

    public function index()
    {
        $program_ids = [
            [16, 1],
            [3, 1],
            [10, 1],
            [2, 1],
            [47, 1],
            [37, 1],
            [74, 1],
            [31, 1],
            [38, 1],
            [27, 1],
        ];

        $this->setChartData($program_ids);

        $eligible_programs = FinancialAidTrackerEligibleProgram::all();
        $university_ids    = $eligible_programs->pluck('university_id');

        $universities = University::orderBy('name')->whereIn('id', $university_ids)->get();

        return view('financial-aid-tracker.index', [
            'universities'    => $universities,
            'universityNames' => json_encode($this->programNames),
            'dataPoints'      => json_encode($this->dataPoints),
            'medians'         => json_encode($this->medians),
        ]);
    }

    public function store(FinancialAidTrackerRequest $request)
    {
        foreach ($request->reports as $report) {
            $financial_aid_tracker                    = new FinancialAidTracker();
            $financial_aid_tracker->university_id     = $report['university_id'];
            $financial_aid_tracker->degree_id         = $report['degree_id'];
            $financial_aid_tracker->aid_amount        = $report['aid_amount'];
            $financial_aid_tracker->aid_qualification = $report['aid_qualification'];

            $financial_aid_tracker->gpa                = $request->gpa;
            $financial_aid_tracker->gmat_score         = $request->gmat_score;
            $financial_aid_tracker->gre_score          = $request->gre_score;
            $financial_aid_tracker->graduation_year    = $request->graduation_year;
            $financial_aid_tracker->immigration_status = $request->immigration_status;
            $financial_aid_tracker->income_3           = $request->income_3;
            $financial_aid_tracker->income_2           = $request->income_2;
            $financial_aid_tracker->income_1           = $request->income_1;
            $financial_aid_tracker->current_income     = $request->current_income;
            $financial_aid_tracker->liquid_assets      = $request->liquid_assets;
            $financial_aid_tracker->illiquid_assets    = $request->illiquid_assets;
            $financial_aid_tracker->liabilities        = $request->liabilities;
            $financial_aid_tracker->total_mortgage     = $request->total_mortgage;
            $financial_aid_tracker->save();
        }

        return response()->json(null, 200);
    }

    public function getChartData(Request $request)
    {
        $gmatMin = null;
        $gmatMax = null;

        if ($request->has('gmat_score') && $request->gmat_score) {
            $gmatRange = $this->getGmatRange($request->input('gmat_score'), 'gmat');
            $gmatMin   = $gmatRange[0];
            $gmatMax   = $gmatRange[1];
        }

        if ($request->has('gre_score') && $request->gre_score) {
            $gmatRange = $this->getGmatRange($request->input('gre_score'), 'gre');
            $gmatMin   = $gmatRange[0];
            $gmatMax   = $gmatRange[1];
        }

        $programIds = $request->program_ids;

        $this->setChartData($programIds, $gmatMin, $gmatMax);

        return response()->json([
            'dataPoints'      => $this->dataPoints,
            'universityNames' => $this->programNames,
            'medians'         => $this->medians,
        ]);
    }

    protected function getGmatRange($score, $score_type)
    {
        $gmat_breakpoints = [0, 650, 700, 720, 740, 760, 800];
        $gre_breakpoints  = [0, 321, 326, 328, 330, 333, 340];

        if ('gmat' == $score_type) {
            foreach ($gmat_breakpoints as $index => $breakpoint) {
                if ($score >= $breakpoint && !($score >= $gmat_breakpoints[$index + 1])) {
                    return [$breakpoint, $gmat_breakpoints[$index + 1]];
                }
            }
        } elseif ('gre' == $score_type) {
            foreach ($gre_breakpoints as $index => $breakpoint) {
                if ($score >= $breakpoint && !($score >= $gre_breakpoints[$index + 1])) {
                    return [$gmat_breakpoints[$index], $gmat_breakpoints[$index + 1]];
                }
            }
        }
    }

    protected function setChartData($programIds, $gmatMin = null, $gmatMax = null)
    {
        $query = FinancialAidTracker::whereInMultiple(['university_id', 'degree_id'], $programIds)
            ->with('university')
            ->orderBy('aid_amount');
        $query = $gmatMin ? $query->where('gmat_score', '>=', $gmatMin) : $query;
        $query = $gmatMax ? $query->where('gmat_score', '<=', $gmatMax) : $query;
        $query = $query->get();

        /*
         * Populate universityNames
         * This will be the categories displayed on the xAxis of the chart
         */
        $eligible_programs_query = FinancialAidTrackerEligibleProgram::whereInMultiple(['university_id', 'degree_id'], $programIds);
        $eligible_programs       = $eligible_programs_query->get();

        $eligible_programs = $eligible_programs->sortBy(function ($model) use ($programIds) {
            return array_search([$model->university_id, $model->degree_id], $programIds);
        });
        $this->programNames = $eligible_programs->pluck('chart_label')->toArray();

        /*
         * Populate dataPoints
         * Format: {X, Y}
         * X is the index (starting from 0) of the universityNames array corresponding to the dataPoint
         * Y is the aid amount
         * These dataPoints will be plotted on the chart
         */
        $this->dataPoints = [];
        foreach ($query as $dataPoint) {
            $structuredDataPoint    = new \StdClass();
            $structuredDataPoint->x = array_search([$dataPoint->university_id, $dataPoint->degree_id], $programIds);
            $structuredDataPoint->y = $dataPoint->aid_amount;
            $this->dataPoints[]     = $structuredDataPoint;
        }

        /*
         * Populate Medians
         * Format: {X, Y}
         * One Median for Each University at Most
         * X is the index (Starting from 0) of the universityNames array cooresponding to the dataPoint
         * Y is the Median of the Aid Amount for that university
         */
        $dataPointsByProgram = $query->groupBy(['university_id', 'degree_id']);
        $this->medians       = [];
        foreach ($eligible_programs as $program) {
            $dataPointsForUniversity = $dataPointsByProgram->get($program->university_id);
            if ($dataPointsForUniversity) {
                $relevantDataPoints = $dataPointsForUniversity->get($program->degree_id);
            } else {
                $relevantDataPoints = null;
            }
            if ($relevantDataPoints) {
                $structuredDataPoint    = new \StdClass();
                $structuredDataPoint->x = array_search([$program->university_id, $program->degree_id], $programIds);
                $structuredDataPoint->y = $relevantDataPoints->median('aid_amount');
                $this->medians[]        = $structuredDataPoint;
            }
        }
    }
}
