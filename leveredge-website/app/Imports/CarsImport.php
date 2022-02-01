<?php

namespace App\Imports;

use App\CarMake;
use App\CarMakeCarModel;
use App\CarModel;
use App\CarYear;
use App\CarYearCarMake;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CarsImport implements ToModel, WithHeadingRow
{
    use Importable;

    /**
     * @param array $row
     */
    public function model(array $row)
    {
        $carYear  = CarYear::firstOrCreate(['year' =>  $row['year']]);
        $carModel = CarModel::firstOrCreate(['model' =>  $row['model']]);
        $carMake  = CarMake::firstOrCreate(['make' =>  $row['make']]);

        if (isset($carYear->id) && isset($carMake->id)) {
            //return dd($carYear);
            CarYearCarMake::firstOrCreate([
                'car_year_id' => $carYear->id,
                'car_make_id' => $carMake->id,
            ],[
                'car_year_id' => $carYear->id,
                'car_make_id' => $carMake->id,
            ]);
        }

        if (!empty($carMake) && !empty($carModel)) {
            CarMakeCarModel::firstOrCreate([
                'car_make_id'  => $carMake->id,
                'car_model_id' => $carModel->id,
            ]);
        }
    }
}
