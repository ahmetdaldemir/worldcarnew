<?php   namespace App\Repository;

use App\Models\Brand;
use App\Models\CarModel;
use Illuminate\Support\Facades\DB;
use App\Models\Car as Cars;


class Car
{

    public function getCar($id)
    {
        $car = Cars::find($id);
        $brand = Brand::find($car->brand);
        $model = CarModel::find($car->model);

        $brand = $brand->brandname ?? "Bulunamadı";
        $model = $model->modelname ?? "Bulunamadı";

        $data = array(
            'name' =>  $brand . " " . $model,
            'image' =>  $car->default_images,
            'fuel' =>  $car->fuel,
            'transmission' => $car->transmission
        );

        return $data;
    }

    public function getAll()
    {
        return Cars::all();
    }

    public static function getBrandModel($brand = null, $model = null)
    {
        $brand = Brand::find($brand);
        $brand = $brand->brandname ?? "Bulunamadı";
        $model = CarModel::find($model);
        $model = $model->modelname ?? "Bulunamadı";
        return $brand . " " . $model;
    }
}
