<?php

namespace App\Http\Controllers;

use App\CarMake;
use App\CarModel;
use App\CarYear;
use App\CarYearCarMake;
use Illuminate\Http\Request;

class CarInformationController extends Controller
{
    public function getMakesByYear(Request $request)
    {
        $carMakeIds = CarYear::where('year',$request->year)->firstOrFail()->carYearCarMakes->pluck('car_make_id');

        return CarMake::whereIn('id',$carMakeIds)->get();
    }

    public function getModelsByMakeAndYear(Request $request)
    {
        $carModelIds = CarMake::where('make',$request->make)->firstOrFail()->carMakeCarModels->pluck('car_model_id');

        return CarModel::whereIn('id',$carModelIds)->get();
    }
}
