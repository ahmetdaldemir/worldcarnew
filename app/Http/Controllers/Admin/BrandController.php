<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Brand;
use App\Models\CarModel;
use Illuminate\Http\Request;

class BrandController extends Controller
{

    public function index()
    {
        $brand = Brand::all();
        return view('admin.brand.index', ['brand' => $brand]);
    }

    public function create()
    {
        return view('admin.brand.create');
    }

    public function edit(Request $request)
    {
        $id =  $request->id;
        $brand = Brand::find($id);
        return view('admin.brand.edit',['brand' => $brand,'id'=>$id]);

    }

    public function save(Request $request)
    {
        $currency = new Brand();
        $currency->brandname = $request->brandname;
        $currency->save();
        return redirect("admin/admin/brand");
    }

    public function update(Request $request)
    {
        $currency =  Brand::find($request->id);
        $currency->brandname = $request->brandname;
        $currency->save();
        return redirect("admin/admin/brand");
    }

    public function destroy(Request $request)
    {
          Brand::where("id",$request->id)->delete();
          CarModel::where("brandid",$request->id)->delete();
          return redirect()->back();
    }

}