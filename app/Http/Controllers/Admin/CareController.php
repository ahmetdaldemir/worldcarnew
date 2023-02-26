<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plate;
use Illuminate\Http\Request;

class CareController extends Controller
{

    public function index()
    {
        $data['plates'] = Plate::all();
        return view('admin.car.healt.index',$data);
    }


    public function create()
    {
        $brands = Brand::all();
        $car_models = CarModel::all();
        $categories = Category::all();
        $engines = Engine::all();
        return view('admin.car.create', ['brands' => $brands, 'car_models' => $car_models, 'categories' => $categories,'engines'=>$engines]);
    }


    public function save(Request $request)
    {
        $car = new Car();
        foreach ($request->all() as $key => $value) {
            $car->$key = $value;
        }
        $car->save();
        return redirect()->back();
    }


    public function show($id)
    {
        //
    }


    public function edit(Request $request)
    {
        $brands = Brand::all();
        $car_models = CarModel::all();
        $categories = Category::all();
        $engines = Engine::all();
        $car = Car::where("id",$request->id)->first();
        return view('admin.car.edit', ['brands' => $brands, 'car_models' => $car_models, 'categories' => $categories,'engines'=>$engines,'car'=>$car]);
    }


    public function update(Request $request)
    {
        $car =  Car::find($request->id);
        foreach ($request->all() as $key => $value) {
            $car->$key = $value;
        }
        $car->save();
        return redirect()->route('admin.admin.cars');
    }


    public function delete(Request $request)
    {
        Car::where("id", $request->id)->delete();
        return redirect()->back();
    }

}
