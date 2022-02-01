<?php

namespace App\Http\Controllers;

use App\LawSchoolOffer;
use Doctrine\DBAL\Schema\Schema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use League\Csv\Writer;

class CompareLawSchoolOffersController extends Controller
{
    public function __construct()
    {
        $programs = LawSchoolOffer::distinct()->get('program')->pluck('program')->toArray();
        View::share(['programs' => $programs]);
    }

    public function index()
    {
        return view('compare-law-school-offers.index');
    }

    public function showResults(Request $request)
    {
        $request->validate([
            'programs.*' => ['required','exists:law_school_offers,program'],
            'lsat_score' => ['required','integer','min:120','max:180'],
            'gpa'        => ['required','numeric']
        ]);

        $request->flash();

        $lsat_range = $this->findNearestLSATBreakpoints($request->lsat_score);
        $gpa_range = $this->findNearestGPABreakpoints($request->gpa);
        $dataRows = [];

        foreach($request->programs as $index => $program){
            $sortedOffers = $this
                ->buildLawSchoolOffersQuery($lsat_range,$gpa_range,$program,'amount')
                ->get()
                ->pluck('amount')
                ->toArray();
            $dataRows[$index] = $this->computeDataRow($sortedOffers, $program);
        }

        return view('compare-law-school-offers.results')
            ->with('dataRows',$dataRows);
    }

    public function downloadResults(Request $request)
    {
        $request->validate([
            'program'       => ['required','exists:law_school_offers,program'],
            'lsat_score'    => ['required','integer','min:120','max:180'],
            'gpa'           => ['required','numeric']
        ]);

        $lsat_range = $this->findNearestLSATBreakpoints($request->lsat_score);
        $gpa_range = $this->findNearestGPABreakpoints($request->gpa);

        $offers = $this->buildLawSchoolOffersQuery(
                $lsat_range,
                $gpa_range,
                $request->program,
                'amount')
            ->get();

        $csv = Writer::createFromFileObject( new \SplTempFileObject());
        $csv->insertOne( \Schema::getColumnListing('law_school_offers') );
        foreach($offers as $offer){
            $csv->insertOne($offer->toArray());
        }

        return response((string) $csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Transfer-Encoding' => 'binary',
            'Content-Disposition' => 'attachment; filename="'.$request->program.'.csv"',
        ]);

    }

    protected function buildLawSchoolOffersQuery($lsat_range, $gpa_range, $program, $sorted_by)
    {
        $query = LawSchoolOffer::query();

        if($lsat_range){
             $query
                ->where('lsat_score','>=',$lsat_range[0])
                ->where('lsat_score', '<', $lsat_range[1]);
        }

        if($gpa_range){
            $query = $query
                ->where('gpa','>=',$gpa_range[0])
                ->where('gpa','<',$gpa_range[1]);
        }

        if($program){
            $query = $query
                ->where('program',$program);
        }

        if($sorted_by){
            $query = $query
                ->orderBy($sorted_by,'asc');
        }

        $query = $query->where('amount','>',1000);

        return $query;
    }

    protected function computeDataRow($sortedOffers, $program){
        $dataRow = [];
        $dataRow['program'] = $program;
        if(sizeof($sortedOffers) > 0){
            $dataRow['min'] = '$' . number_format($this->getPercentile($sortedOffers,0)) ;
            $dataRow['25th_percentile'] = '$' . number_format($this->getPercentile($sortedOffers,25));
            $dataRow['median'] = '$' . number_format($this->getPercentile($sortedOffers,50));
            $dataRow['75th_percentile'] = '$' . number_format($this->getPercentile($sortedOffers,75));
            $dataRow['max'] = '$' . number_format($this->getPercentile($sortedOffers,100));
        }else{
            $dataRow['min'] = 'Insufficient Data';
            $dataRow['25th_percentile'] = 'Insufficient Data';
            $dataRow['median'] = 'Insufficient Data';
            $dataRow['75th_percentile'] = 'Insufficient Data';
            $dataRow['max'] = 'Insufficient Data';
        }
        return $dataRow;
    }

    protected function getPercentile($array, $percentile)
    {
        $percentile = min(100, max(0, $percentile));
        $array = array_values($array);
        sort($array);
        $index = ($percentile / 100) * (count($array) - 1);
        $fractionPart = $index - floor($index);
        $intPart = floor($index);

        $percentile = $array[$intPart];
        $percentile += ($fractionPart > 0) ? $fractionPart * ($array[$intPart + 1] - $array[$intPart]) : 0;

        return $percentile;
    }

    protected function findNearestLSATBreakpoints($lsat_score){
        $breakpoints = LawSchoolOffer::LSAT_BREAKPOINTS;
        return $this->findNearestBreakpoints($lsat_score, $breakpoints);
    }

    protected function findNearestGPABreakpoints($gpa){
        $breakpoints = LawSchoolOffer::GPA_BREAKPOINTS;
        return $this->findNearestBreakpoints($gpa, $breakpoints);
    }

    protected function findNearestBreakpoints($score, $breakpoints){
        $smallIndex = 0;

        foreach($breakpoints as $index => $breakpoint){
            if($breakpoint <= $score){
                $smallIndex = $index;
            }
        }

        if($smallIndex ===  sizeof($breakpoints) - 1 ){
            $smallIndex -= 1;
        }

        return [
          $breakpoints[$smallIndex],
          $breakpoints[$smallIndex + 1]
        ];

    }




}
