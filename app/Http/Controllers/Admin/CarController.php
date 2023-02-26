<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\Category;
use App\Models\Engine;
use App\Models\Image as ImageUpload;
use App\Models\PeriodPrice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Service\Image as ServiceImage;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Car::all();
        return view('admin.car.index', ['cars' => $cars]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::all();
        $car_models = CarModel::all();
        $categories = Category::all();
        $engines = Engine::all();
        return view('admin.car.create', ['brands' => $brands, 'car_models' => $car_models, 'categories' => $categories,'engines'=>$engines]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @param Car $model
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function save(Request $request)
    {
        $car = new Car();
        foreach ($request->all() as $key => $value) {
            $car->$key = $value;
        }
        $car->save();
        return redirect()->back();
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $brands = Brand::all();
        $car_models = CarModel::all();
        $categories = Category::all();
        $engines = Engine::all();
        $car = Car::where("id",$request->id)->first();
        return view('admin.car.edit', ['brands' => $brands, 'car_models' => $car_models, 'categories' => $categories,'engines'=>$engines,'car'=>$car]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $car =  Car::find($request->id);
        foreach ($request->all() as $key => $value) {
            $car->$key = $value;
        }
        $car->save();
        return redirect()->route('admin.admin.cars');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        Car::where("id", $request->id)->delete();
        return redirect()->back();
    }


    /**
     * Update is_active.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function is_active(Request $request)
    {
        $status = $request->is_active == 0 ? 1 : 0;
        Car::where("id", $request->id)->update(['is_active' => $status]);
        return redirect()->back();
    }

    public function getAll($id_location)
    {
        $cars =  Car::all();
        foreach($cars as $item)
        {
                $brand = \App\Models\Brand::find($item->brand)->brandname ?? null;
                $car_model = \App\Models\CarModel::find($item->model)->modelname ?? null;
                $year = $item->year;
                $engine = \App\Models\Engine::find($item->engine)->title;
                $data[] = array(
                    'id' => $item->id,
                    'title' => $brand." | ".$car_model." | ".$year,
                );
        }
        return $data;
//        foreach ($car as $item) {
//            $prices = PeriodPrice::where("id_location", $id_location)->where("id_car", $item->id);
//            if ($prices->count() > 0) {
//
//                $car[] = array(
//
//                );
//
//
//                foreach ($prices->get() as $val) {
//                    $data[] = array(
//                        'id_car' => $val->id_car,
//                        'mounth' => $val->mounth,
//                        'id_location' => $val->id_location,
//                        'period1' => $val->period1,
//                        'period2' => $val->period2,
//                        'period3' => $val->period3,
//                        'period4' => $val->period4,
//                        'period5' => $val->period5,
//                        'period6' => $val->period6,
//                        'period7' => $val->period7,
//                        'discount' => $val->discount,
//                        'status' => $val->status,
//                    );
//                }
//                return $data;
//            } else {
//                return $car;
//            }
//        }

    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function image(Request $request)
    {
        return view('admin.car.image', ['id' => $request->id]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function uploadImage(Request $request)
    {
        $upload = new ServiceImage();
        $x = $upload->uploadImage($request,747,330,'cars');

        $image = new ImageUpload();
        $image->title = $x;
        $image->module = "cars";
        $image->id_module = $request->id;
        $image->save();
        return redirect()->back();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function defaultImage(Request $request)
    {
        $upload = new ServiceImage();
        $x = $upload->uploadImage($request,"287","151",'cars');
        $car = Car::find($request->id);
        $car->default_images = $x;
        $car->save();
        return redirect()->back();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function imageDelete(Request $request)
    {
        $image = ImageUpload::find($request->id);
        $file= $image->title;
        $filename = public_path().'/storage/app/public/cars/'.$file;
        \File::delete($filename);
         ImageUpload::where('id', $request->id)->delete();
        return redirect()->back();
    }



}
