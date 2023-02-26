<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\Category;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

class ModelController extends Controller
{

    public function getModel(Request $request)
    {
        $data = array();
      $x  = CarModel::where("brandid",$request->id)->get();
      foreach ($x as $val)
      {
          $data[] = array(
              'id' => $val->id,
              'modelname' => $val->modelname
          );
      }
     echo json_encode($data);
    }


    public function index(Request $request)
    {
        $id = $request->id;
        $model = CarModel::where("brandid",$request->id)->get();
        $brandname = Brand::find($request->id)->brandname ?? null;
        return view('admin.car_model.index', ['model' => $model,'brandname' => $brandname,'id' => $id]);
    }

    public function create(Request $request)
    {
        $id = $request->id;
        return view('admin.car_model.create',['id'=> $id]);
    }

    public function edit(Request $request)
    {
        $id =  $request->id;
        $brand = CarModel::find($id);
        return view('admin.car_model.edit',['brand' => $brand,'id'=>$id]);

    }

    public function save(Request $request)
    {
        $currency = new CarModel();
        $currency->brandid = $request->brandid;
        $currency->modelname = $request->modelname;
        $currency->save();
        return redirect("admin/admin/car_model?id=$request->brandid");
    }

    public function update(Request $request)
    {
        $currency =  CarModel::find($request->id);
        $currency->brandid = $request->id;
        $currency->modelname = $request->modelname;
        $currency->save();
        return redirect("admin/admin/brand");
    }

    public function delete(Request $request)
    {
        CarModel::where("id",$request->id)->delete();
        return redirect()->back();
    }


}
