<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\City;
use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Language;
use App\Models\LanguageValue;
use App\Models\Location;
use App\Models\LocationValue;
use App\Models\PeriodPrice;
use App\Models\TransferZoneFee;
use App\Models\TransferZoneFeeSub;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Service\GetData;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::join('location_values', 'locations.id', '=', 'location_values.id_location')->select('locations.*', 'location_values.title')->where('location_values.id_lang', 1)->where('locations.id_parent', 0)->get();
        $language = Language::all();
        return view('admin.defination.locations.index', ['locations' => $locations, 'language' => $language]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locations = Location::join('location_values', 'locations.id', '=', 'location_values.id_location')
            ->select('locations.*', 'location_values.title')->where('location_values.id_lang', 1)->get();
        $language = Language::all();
        return view('admin.defination.locations.create', ['locations' => $locations, 'languages' => $language]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $language = Language::all();

        $location = new Location();
        $location->type = $request->type;
        $location->id_parent = $request->id_parent;
        $location->price = $request->price;
        $location->sort = $request->sort;
        $location->drop_price = $request->drop_price;
        $location->min_day = $request->min_day ?? 0;
        $location->save();
        $lastId = $location->id;

        $i = 0;
        foreach ($language as $item) {
            $locationvalue = new LocationValue();
            $locationvalue->id_location = $lastId;
            $locationvalue->id_lang = $item->id;
            $locationvalue->title = $request->title[$i];
            $locationvalue->meta_title = $request->meta_title[$i];
            $locationvalue->save();
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
    public function sub(Request $request)
    {
        $locations = Location::join('location_values', 'locations.id', '=', 'location_values.id_location')->select('locations.*', 'location_values.title')->where('location_values.id_lang', 1)
            ->where('locations.id_parent', $request->id)->get();
        $language = Language::all();
        return view('admin.defination.locations.sub', ['locations' => $locations, 'language' => $language]);
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function return_zone(Request $request)
    {
        $locations = Location::join('location_values', 'locations.id', '=', 'location_values.id_location')->select('locations.*', 'location_values.title')->where('location_values.id_lang', 1)->where('locations.id_parent', 0)->get();
        $language = Language::all();
//        $transferzone = DB::table('transfer_zone_fee')
//            ->join('location_values', 'transfer_zone_fee.id_city', '=', 'location_values.id_location')
//            ->select('transfer_zone_fee.*', 'location_values.title')->where('location_values.id_lang',1)
//            ->get();
        return view('admin.defination.locations.return-zone', ['locations' => $locations, 'language' => $language, 'title' => $request->title, 'id' => $request->id]);
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function return_zone_add(Request $request)
    {
        $locations = Location::join('location_values', 'locations.id', '=', 'location_values.id_location')
            ->select('locations.*', 'location_values.title')->where('location_values.id_lang', 1)->get();
        $language = Language::all();
        return view('admin.defination.locations.return-zone-add', ['locations' => $locations, 'languages' => $language, 'id' => $request->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $locations = Location::all();
        $language = Language::all();
        $id = $request->id;
        $location = Location::find($request->id);
        return view('admin.defination.locations.edit', ['locations' => $locations, 'location' => $location, 'languages' => $language, 'id' => $id]);
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

        $location = Location::find($request->id);
        $location->type = $request->type;
        $location->sort = $request->sort;
        $location->price = $request->price;
        $location->id_parent = $request->id_parent;
        $location->min_day = $request->min_day;
        $location->drop_price = $request->drop_price;
        $location->save();
        $lastId = $request->id;

        $i = 0;
        foreach ($language as $item) {

            $x = LocationValue::where('id_location', $lastId)->where('id_lang', $item->id)->first();
            $x->title = $request->title[$i];
            $x->meta_title = $request->meta_title[$i];
            $x->save();
            $i++;
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;

        Location::where("id", $id)->delete();
        LocationValue::where("id_location", $id)->delete();
        return redirect()->back();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function getdeliveryArea($id)
    {
        $repsonse = DB::table('delivery_area')
            ->join('delivery_area_language', 'delivery_area.id', '=', 'delivery_area_language.id_delivery_area')
            ->where('delivery_area_language.id_lang', 1)
            ->where('delivery_area.id_location', $id)
            ->select('delivery_area.*', 'delivery_area_language.title')
            ->get();
        return $repsonse;
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function editZone(Request $request)
    {
        $transferzone = DB::table("transfer_zone_fee")->find($request->id);

        $transferzonesubs = TransferZoneFeeSub::where("id_transferzone", $request->id)->select('id', DB::raw('count(*) as total'))->groupBy("type");
         $language = Language::all();
        return view('admin.defination.locations.return-zone-edit', ['transferzone' => $transferzone, 'transferzonesubs' => $transferzonesubs, 'id' => $request->id, 'languages' => $language]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function setdeliveryArea(Request $request)
    {
        $language = Language::all();
        if ($request->input('id') == 0) {
            $id = DB::table('delivery_area')->insertGetId(
                array('id_location' => $request->input('id_location'))
            );
            $last_id = $id;
            $i = 0;
            foreach ($language as $val) {
                DB::table('delivery_area_language')->insert(
                    array(
                        'id_delivery_area' => $last_id,
                        'id_lang' => $val->id,
                        'title' => $request->input('title')[$i],
                        'meta_title' => $request->input('meta_title')[$i],
                    )
                );
                $i++;
            }
        } else {

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function settransferZoneFee(Request $request)
    {
        $id_location = $request->id_location;
        $id_location_transfer_zone_array = $request->id_location_transfer_zone;
        $distance_array = $request->distance;
        $price_array = $request->price;
        $status_array = $request->status;
        $i = 0;
        foreach ($id_location_transfer_zone_array as $lval) {
          TransferZoneFee::updateOrCreate(
                ['id_location' => $id_location, 'id_location_transfer_zone' => $lval],
                [
                    'distance' => $distance_array[$i],
                    'price' => $price_array[$i],
                    'status' => $status_array[$i],
                ]
            );
            $i++;
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function updatetransferZoneFee(Request $request)
    {
        $language = Language::all();

        $id = DB::table('transfer_zone_fee')->where('id', $request->id)->update(
            array(
                'id_location' => $request->id_location,
                'id_city' => $request->id_city,
                'distance' => $request->distance,
                'price' => $request->price,
                'status' => 1,
            )
        );
        $last_id = $request->id;

        $transferfee = $request->transferzonesub;
        foreach ($transferfee as $va) {
            foreach ($language as $val_lang) {
                DB::table('transfer_zone_fee_subs')->where('id', $request->id_zone)->update(
                    array(
                        'id_lang' => $val_lang->id,
                        'id_transferzone' => $last_id,
                        'type' => $va['type'],
                        'title' => $va['title'][$val_lang->id] ?? null,
                        'meta_title' => $va['meta_title'][$val_lang->id] ?? null,
                    )
                );
            }
        }
//            return redirect()->back();
        return redirect('/admin/admin/locations/return_zone_add?id=' . $request->id_location . '')->with('status', 'Kayıt Tamamlandır');

    }


    public function deleteDeliveryArea(int $id)
    {
        if (isset($id)) {
            DB::table('delivery_area')->where("id", $id)->delete();
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function getTransferZoneFee($id, $code)
    {
        $response = DB::table('transfer_zone_fee')->where('id_location', $id)->where('id_city', $code)->first();
        return $response;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function getTransferZoneFeeSubs($id, $code)
    {
        $id_transferfee = DB::table('transfer_zone_fee')->where('id_location', $id)->where('id_city', $code);
        if ($id_transferfee->count() > 0) {
            $a = $id_transferfee->first()->id;
            $response = DB::table("transfer_zone_fee_subs")->where("id_transferzone", $a)->get();
            return $response;
        } else {
            return null;
        }

    }

    public function getCity($id)
    {
        $city = DB::table("city")->get();
        foreach ($city as $val) {
            $data[] = array(
                'id_city' => $val->id,
                'name_city' => $val->name,
                'code_city' => $val->code,
                'transfer_zone_fee' => $this->getTransferZoneFee($id, $val->code),
                'transfer_zone_fee_subs' => $this->getTransferZoneFeeSubs($id, $val->code),
            );
        }
        echo json_encode($data);
    }


    public function addPeriodPrice(Request $request)
    {

        $x = 0;
        foreach ($request->id_car as $car) {

            $perios = PeriodPrice::updateOrCreate(
                ['id_car' => $car, 'mounth' => $request->mounth, 'id_location' => $request->id_location],
                [
                    'id_car' => $car, 'mounth' => $request->mounth, 'id_location' => $request->id_location,
                    'period1' => $request->period1[$x],
                    'period2' => $request->period2[$x],
                    'period3' => $request->period3[$x],
                    'period4' => $request->period4[$x],
                    'period5' => $request->period5[$x],
                    'period6' => $request->period6[$x],
                    'period7' => $request->period7[$x],
                    'discount' => $request->discount[$x],
                    'min_day' => $request->min_day[$x],
                    'status' => $request->status[$x],
                ]
            );

            $x++;
        }
        return $perios;

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function price(Request $request)
    {
        return view('admin.defination.locations.price', ['id' => $request->id, 'title' => $request->title]);
    }

    public function getPrice(Request $request)
    {
        $cars = Car::all();
        foreach ($cars as $item) {
            $brand = \App\Models\Brand::find($item->brand)->brandname ?? null;
            $car_model = \App\Models\CarModel::find($item->model)->modelname ?? null;
            $year = $item->year;
            $engine = \App\Models\Engine::find($item->engine)->title;
            $data[] = array(
                'id' => $item->id,
                'title' => $brand . " | " . $car_model . " | " . $item->car_name . " | " . $year,
                'period1'  => self::getField($request->id_location, $request->mounth, $item->id, 'period1'),
                'period2'  => self::getField($request->id_location, $request->mounth, $item->id, 'period2'),
                'period3'  => self::getField($request->id_location, $request->mounth, $item->id, 'period3'),
                'period4'  => self::getField($request->id_location, $request->mounth, $item->id, 'period4'),
                'period5'  => self::getField($request->id_location, $request->mounth, $item->id, 'period5'),
                'period6'  => self::getField($request->id_location, $request->mounth, $item->id, 'period6'),
                'period7'  => self::getField($request->id_location, $request->mounth, $item->id, 'period7'),
                'discount' => self::getField($request->id_location, $request->mounth, $item->id, 'discount'),
                'min_day'  => self::getField($request->id_location, $request->mounth, $item->id, 'min_day'),
                'status'   => self::getField($request->id_location, $request->mounth, $item->id, 'status'),
            );
        }
        return $data;
    }

    public function getField($id_location, $id_mounth, $id_car, $field)
    {
        $x = PeriodPrice::where('id_location', $id_location)->where('mounth', $id_mounth)->where('id_car', $id_car)->first();
        return $x->$field ?? 0;
    }

    public function deleteZone(Request $request)
    {
        DB::table('transfer_zone_fee')->find($request->id);
        DB::table('transfer_zone_fee_subs')->where("id_transferzone", $request->id)->delete();
        return redirect()->back();
    }

    public function deleteZoneSub(Request $request)
    {
        DB::table('transfer_zone_fee_subs')->where("id", $request->zone)->update(['title' => null]);
    }


    public function showTransferZone(Request $request)
    {
        $transferZone = \DB::table('transfer_zone_fee')->find($request->id);
        $zone = array(
            'id_city' => City::find($transferZone->id_city)->name,
            'id_location' => LocationValue::where("id_lang", 1)->where("id_location", $transferZone->id_location)->first()->title,
            'distance' => $transferZone->distance,
            'price' => $transferZone->price,
            'status' => $transferZone->status,
        );
        $transferzonesubs = TransferZoneFeeSub::where("id_transferzone", $request->id)->get();
        foreach ($transferzonesubs as $item) {
            $subs[] = array(
                'id_lang' => Language::find($item->id_lang)->title,
                'title' => $item->title,
            );
        }
        $data = array(
            'data' => $zone,
            'zones' => $subs,
        );
        echo json_encode($data);
    }

    public function updateLocationStatus(Request $request)
    {
        $location = Location::find($request->id);
        $location->status = $request->status;
        $location->save();
        return redirect()->back();
    }

    public function rentalPeriod(Request $request)
    {
        $location = Location::find($request->id);
        $location->min_day = $request->min_day;
        $location->save();
    }


}
