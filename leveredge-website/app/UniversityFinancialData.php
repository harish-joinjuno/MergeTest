<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UniversityFinancialData extends Model
{

    protected $table = 'university_financial_datas';

    public function getTuitionIn201819In2019DollarsUsingTenYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('10_year_CAGR')), 1) );
    }
    public function getTuitionIn201920In2019DollarsUsingTenYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('10_year_CAGR')), 2) );
    }
    public function getTuitionIn202021In2019DollarsUsingTenYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('10_year_CAGR')), 3) );
    }
    public function getTuitionIn202122In2019DollarsUsingTenYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('10_year_CAGR')), 4) );
    }
    public function getTuitionIn202223In2019DollarsUsingTenYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('10_year_CAGR')), 5) );
    }
    public function getTuitionIn202324In2019DollarsUsingTenYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('10_year_CAGR')), 6) );
    }
    public function getTuitionIn202425In2019DollarsUsingTenYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('10_year_CAGR')), 7) );
    }
    public function getTuitionIn202526In2019DollarsUsingTenYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('10_year_CAGR')), 8) );
    }
    public function getTuitionIn202627In2019DollarsUsingTenYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('10_year_CAGR')), 9) );
    }
    public function getTuitionIn202728In2019DollarsUsingTenYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('10_year_CAGR')), 10) );
    }
    public function getTuitionIn202829In2019DollarsUsingTenYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('10_year_CAGR')), 11) );
    }
    public function getTuitionIn202930In2019DollarsUsingTenYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('10_year_CAGR')), 12) );
    }
    public function getTuitionIn203031In2019DollarsUsingTenYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('10_year_CAGR')), 13) );
    }
    public function getTuitionIn203132In2019DollarsUsingTenYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('10_year_CAGR')), 14) );
    }
    public function getTuitionIn203233In2019DollarsUsingTenYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('10_year_CAGR')), 15) );
    }
    public function getTuitionIn203334In2019DollarsUsingTenYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('10_year_CAGR')), 16) );
    }
    public function getTuitionIn203435In2019DollarsUsingTenYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('10_year_CAGR')), 17) );
    }
    public function getTuitionIn203536In2019DollarsUsingTenYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('10_year_CAGR')), 18) );
    }
    public function getTuitionIn203637In2019DollarsUsingTenYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('10_year_CAGR')), 19) );
    }
    public function getTuitionIn203738In2019DollarsUsingTenYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('10_year_CAGR')), 20) );
    }
    public function getTuitionIn203839In2019DollarsUsingTenYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('10_year_CAGR')), 21) );
    }
    public function getTuitionIn203940In2019DollarsUsingTenYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('10_year_CAGR')), 22) );
    }
    public function getTuitionIn204041In2019DollarsUsingTenYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('10_year_CAGR')), 23) );
    }
    public function getTuitionIn204142In2019DollarsUsingTenYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('10_year_CAGR')), 24) );
    }
    public function getTuitionIn204243In2019DollarsUsingTenYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('10_year_CAGR')), 25) );
    }
    public function getTuitionIn204344In2019DollarsUsingTenYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('10_year_CAGR')), 26) );
    }
    public function getTuitionIn204445In2019DollarsUsingTenYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('10_year_CAGR')), 27) );
    }
    public function getTuitionIn204546In2019DollarsUsingTenYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('10_year_CAGR')), 28) );
    }
    public function getTuitionIn204647In2019DollarsUsingTenYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('10_year_CAGR')), 29) );
    }
    public function getTuitionIn204748In2019DollarsUsingTenYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('10_year_CAGR')), 30) );
    }
    public function getTuitionIn204849In2019DollarsUsingTenYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('10_year_CAGR')), 31) );
    }




    public function getTuitionIn201819In2019DollarsUsingThreeYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('3_year_CAGR')), 1) );
    }
    public function getTuitionIn201920In2019DollarsUsingThreeYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('3_year_CAGR')), 2) );
    }
    public function getTuitionIn202021In2019DollarsUsingThreeYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('3_year_CAGR')), 3) );
    }
    public function getTuitionIn202122In2019DollarsUsingThreeYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('3_year_CAGR')), 4) );
    }
    public function getTuitionIn202223In2019DollarsUsingThreeYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('3_year_CAGR')), 5) );
    }
    public function getTuitionIn202324In2019DollarsUsingThreeYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('3_year_CAGR')), 6) );
    }
    public function getTuitionIn202425In2019DollarsUsingThreeYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('3_year_CAGR')), 7) );
    }
    public function getTuitionIn202526In2019DollarsUsingThreeYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('3_year_CAGR')), 8) );
    }
    public function getTuitionIn202627In2019DollarsUsingThreeYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('3_year_CAGR')), 9) );
    }
    public function getTuitionIn202728In2019DollarsUsingThreeYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('3_year_CAGR')), 10) );
    }
    public function getTuitionIn202829In2019DollarsUsingThreeYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('3_year_CAGR')), 11) );
    }
    public function getTuitionIn202930In2019DollarsUsingThreeYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('3_year_CAGR')), 12) );
    }
    public function getTuitionIn203031In2019DollarsUsingThreeYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('3_year_CAGR')), 13) );
    }
    public function getTuitionIn203132In2019DollarsUsingThreeYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('3_year_CAGR')), 14) );
    }
    public function getTuitionIn203233In2019DollarsUsingThreeYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('3_year_CAGR')), 15) );
    }
    public function getTuitionIn203334In2019DollarsUsingThreeYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('3_year_CAGR')), 16) );
    }
    public function getTuitionIn203435In2019DollarsUsingThreeYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('3_year_CAGR')), 17) );
    }
    public function getTuitionIn203536In2019DollarsUsingThreeYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('3_year_CAGR')), 18) );
    }
    public function getTuitionIn203637In2019DollarsUsingThreeYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('3_year_CAGR')), 19) );
    }
    public function getTuitionIn203738In2019DollarsUsingThreeYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('3_year_CAGR')), 20) );
    }
    public function getTuitionIn203839In2019DollarsUsingThreeYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('3_year_CAGR')), 21) );
    }
    public function getTuitionIn203940In2019DollarsUsingThreeYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('3_year_CAGR')), 22) );
    }
    public function getTuitionIn204041In2019DollarsUsingThreeYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('3_year_CAGR')), 23) );
    }
    public function getTuitionIn204142In2019DollarsUsingThreeYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('3_year_CAGR')), 24) );
    }
    public function getTuitionIn204243In2019DollarsUsingThreeYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('3_year_CAGR')), 25) );
    }
    public function getTuitionIn204344In2019DollarsUsingThreeYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('3_year_CAGR')), 26) );
    }
    public function getTuitionIn204445In2019DollarsUsingThreeYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('3_year_CAGR')), 27) );
    }
    public function getTuitionIn204546In2019DollarsUsingThreeYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('3_year_CAGR')), 28) );
    }
    public function getTuitionIn204647In2019DollarsUsingThreeYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('3_year_CAGR')), 29) );
    }
    public function getTuitionIn204748In2019DollarsUsingThreeYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('3_year_CAGR')), 30) );
    }
    public function getTuitionIn204849In2019DollarsUsingThreeYearCAGRAttribute(){
        return $this->tuition_in_2017_18_in_2019_dollars*(  pow( (1 + $this->getAttribute('3_year_CAGR')), 31) );
    }

}
