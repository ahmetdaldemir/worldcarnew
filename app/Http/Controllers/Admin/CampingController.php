<?php

namespace App\Http\Controllers\Admin;

use App\Models\CampingLanguage;
use App\Models\CustomerType;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Camping;
use App\Models\CarModel;
use App\Models\Car;
use App\Models\Category;
use App\Models\Currency;
use App\Models\DestinationLanguage;
use App\Models\Language;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;

class CampingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $car_data = array();
        $camping = Camping::all();
        $currency = Currency::all();
        $car = Car::all();
        $customer_type = CustomerType::all();
        foreach ($car as $car_val) {
            $car_data[] = array(
                'id' => $car_val->id,
                'brand' => Brand::find($car_val->brand)->brandname ?? null,
                'model' => CarModel::find($car_val->model)->modelname ?? null,
                'year' => $car_val->year,
            );
        }

        $location = DB::table('locations')->leftJoin('location_values', 'locations.id', '=', 'location_values.id_location')
            ->where('location_values.id_lang', '1')->where('locations.status', '1')->where('locations.id_parent', '0')->select('location_values.title', 'locations.id')->get();


        return view('admin.camping.index', ['camping' => $camping, 'currency' => $currency,
            'location' => $location,
            'cars' => $car_data,
            'customer_type' => $customer_type]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $car_data = array();

        $camping = Camping::all();
        $currency = Currency::all();
        $car = Car::all();
        $customer_type = CustomerType::all();

        $location = DB::table('locations')->leftJoin('location_values', 'locations.id', '=', 'location_values.id_location')
            ->where('location_values.id_lang', '1')->where('locations.status', '1')->where('locations.id_parent', '0')->select('location_values.title', 'locations.id')->get();

        $languages = Language::all();
        foreach ($car as $car_val) {
            $car_data[] = array(
                'id' => $car_val->id,
                'brand' => Brand::find($car_val->brand)->brandname ?? null,
                'model' => CarModel::find($car_val->model)->modelname ?? null,
                'year' => $car_val->year,
            );
        }
        return view('admin.camping.create', ['camping' => $camping, 'currency' => $currency,
            'location' => $location,
            'cars' => $car_data,
            'customer_type' => $customer_type, 'languages' => $languages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @param Camping $model
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function save(Request $request)
    {
        $language = Language::all();

        $camping = new Camping();
        $camping->id_car = $request->id_car;
        $camping->price1 = $request->price1;
        $camping->price2 = $request->price2;
        $camping->price3 = $request->price3;
        $camping->price4 = $request->price4;
        $camping->id_currency = $request->id_currency;
        $camping->start_date = $request->start_date;
        $camping->finish_date = $request->finish_date;
        $camping->period_validity = $request->period_validity;
        $camping->customer_type = $request->customer_type;
        $camping->location = $request->location;
        $camping->destination = json_encode($request->destination);
        $camping->status = 1;
        $camping->save();

        $i = 0;
        foreach ($language as $val) {
            $CampingLanguage = new CampingLanguage();
            $CampingLanguage->id_camping = $camping->id;
            $CampingLanguage->id_lang = $val->id;
            $CampingLanguage->title = $request->title[$i];
            $CampingLanguage->description = $request->description[$i];
            $CampingLanguage->slug = Str::of(trim($request->title[$i]))->slug('-');
            $CampingLanguage->save();
            $i++;
        }

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
        $car_data = array();

        $camping = Camping::where("id", $request->id)->first();
        $currency = Currency::all();
        $car = Car::all();
        $customer_type = CustomerType::all();

        $location = DB::table('locations')->leftJoin('location_values', 'locations.id', '=', 'location_values.id_location')
            ->where('location_values.id_lang', '1')->where('locations.status', '1')->where('locations.id_parent', '0')->select('location_values.title', 'locations.id')->get();

        $languages = Language::all();
        foreach ($car as $car_val) {
            $car_data[] = array(
                'id' => $car_val->id,
                'brand' => Brand::find($car_val->brand)->brandname ?? null,
                'model' => CarModel::find($car_val->model)->modelname ?? null,
                'year' => $car_val->year,
            );
        }
        return view('admin.camping.edit', [
            'camping' => $camping,
            'currency' => $currency,
            'location' => $location,
            'cars' => $car_data,
            'customer_type' => $customer_type,
            'languages' => $languages,
            'id' => $request->id
        ]);
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
        $language = Language::all();

        $camping = Camping::find($request->id);
        $camping->id_car = $request->id_car;
        $camping->price1 = $request->price1;
        $camping->price2 = $request->price2;
        $camping->price3 = $request->price3;
        $camping->price4 = $request->price4;
        $camping->id_currency = $request->id_currency;
        $camping->start_date = $request->start_date;
        $camping->finish_date = $request->finish_date;
        $camping->period_validity = $request->period_validity;
        $camping->customer_type = $request->customer_type;
        $camping->location = $request->location;
        $camping->destination = json_encode($request->destination);
        $camping->status = 1;
        $camping->save();


        $id = $request->id;
        $i = 0;
        foreach ($language as $val) {
            CampingLanguage::where('id_lang', $val->id)->where('id_camping', $id)->update(array(
                'id_camping' => $id,
                'id_lang' => $val->id,
                'title' => $request->title[$i],
                'description' => $request->description[$i],
                'slug' => Str::of(trim($request->title[$i]))->slug('-')
            ));
            $i++;
        }
        return redirect('admin/admin/camping');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        Camping::where("id", $request->id)->delete();
        return redirect()->back();
    }

    public function statusChange(Request $request)
    {
        $location = Camping::find($request->id);
        $location->status = $request->status;
        $location->save();
        return redirect()->back();
    }
}
