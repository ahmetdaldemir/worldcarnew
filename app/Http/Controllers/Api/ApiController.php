<?php namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Customer;
use App\Models\CustomerNote;
use App\Models\Ekstra;
use App\Models\Language;
use App\Models\Location;
use App\Models\LocationValue;
use App\Models\Plate;
use App\Models\Reservation;
use App\Models\Supplier;
use App\Models\TransferZoneFee;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApiController extends Controller
{

    public function locations()
    {
        $location = Location::getViewCenter();
        foreach ($location as $item) {
            if ($item->id_parent == 0) {
                $data[] = array(
                    "name" => $item->title,
                    "id" => $item->id,
                    "children" => Location::getViewLocationId($item->id),
                );
            }
        }
        return response()->json(['data' => $data], 200);
    }

    public function version()
    {
        return response()->json(['status' => "ok", 'version' => "1.6"], 200);
    }

    public function deals()
    {
        $data = array(
            'id' => 1,
            'name' => "test",
            'img' => "http://",
            'description' => "",
        );
        return response()->json(['data' => $data], 200);
    }

    public function history()
    {
        $data = array(
            "id" => "1",
            "location" => "Ankara",
            "target" => "Kayseri",
            "from" => "01.03.2021 10:00",
            "to" => "05.03.2021 10:00"
        );
        return response()->json(['data' => $data], 200);
    }

    public function notifications()
    {
        $data = array(
            'id' => 1,
            'name' => "test",
            'img' => "http://",
            'description' => "",
        );
        return response()->json(['data' => $data], 200);
    }

    public function getPlate(Request $response)
    {
        $data = Plate::where('id_car', $response->id_car)->get();
        return response()->json(['data' => $data], 200);
    }

    public function get_customer(Request $request)
    {
        $data = [];
        $x = [];
        $a = [];

        $emailControl = strpos($request->searchText, '@');

        if ($emailControl === TRUE) {
            $customer = Customer::where("email", "like", Str::upper($request->searchText) . '%')
                ->get();
            $x[] = $customer->implode('id', ', ');
        }

        $customer = Customer::where("email", "like", $request->searchText . '%')
            ->orWhere("fullname", "like", '%' . Str::upper($request->searchText) . '%')
            ->orWhere("firstname", "like", '%' . Str::upper($request->searchText) . '%')
            ->orWhere("lastname", "like", '%' . Str::upper($request->searchText) . '%')
            ->orWhere("phone", $request->searchText)
            ->get();
        $x[] = $customer->implode('id', ', ');
        $fill = array_filter($x);

        if (!empty($fill)) {
            foreach ($fill as $item) {
                $xyz = explode(",", $item);
                foreach ($xyz as $i) {
                    $a[] = $i;
                }
            }

            $customer = Customer::whereIn('id', $a)->paginate(100);
            foreach ($customer as $item) {
                $data[] = array(
                    'id' => $item->id,
                    'firstname' => $item->firstname,
                    'lastname' => $item->lastname,
                    'email' => $item->email,
                    'phone' => $item->phone,
                    'mobile' => $item->phone1,
                    'birthday' => Carbon::parse($item->birthday)->format('d-m-Y'),
                    'gender' => $item->gender,
                    'nationality' => $item->nationality,
                    'point' => $item->point,
                    'remaining_points' => $item->remaining_points,
                    'total_reservation' => $this->get_reservation_for_customer($item->id),
                    'cancel_reservation' => $this->get_reservation_for_status($item->id, 'closed'),
                    'waiting_reservation' => $this->get_reservation_for_status($item->id, 'waiting'),
                    'comfirm_reservation' => $this->get_reservation_for_status($item->id, 'comfirm'),
                    'complated_reservation' => $this->get_reservation_for_status($item->id, 'complated'),
                    'notes' => $item->customernote()
                );
            }
        }

        return $data;
    }


    public function get_reservation_for_customer($id_customer)
    {
        return Reservation::where("id_customer", $id_customer)->count();
    }

    public function get_reservation_for_status($id_customer, $status)
    {
        return Reservation::where("id_customer", $id_customer)->where("status", $status)->count();
    }

    public function feedbackform()
    {
        return view('api/feedbackform');
    }

    public function getsupplierocation()
    {

        $location = array();
        $langId = Language::where("url", app()->getLocale())->first()->id;

        $locations = Location::where("id_parent", 0)->get();
        foreach ($locations as $item) {
            $locatiValue = LocationValue::where("id_location", $item->id)->where("id_lang", $langId)->first();
            $location[] = array(
                'id' => $item->id,
                'title' => $locatiValue->title,
                'id_parent' => $item->id_parent,
                'type' => $locatiValue->type,
                'parentList' => Location::join('location_values', 'locations.id', '=', 'location_values.id_location')->select('locations.*', 'location_values.title')->where('locations.id_parent', $item->id)->where('location_values.id_lang', $langId)->get(),
            );

        }
        return $location;
    }

    public function datas()
    {
        // $data['cars'] = Car::all();
        $data['ekstras'] = Ekstra::all();
        $data['center_location_pick_up'] = Location::getViewCenter();
        $data['currency'] = Currency::all();
        $data['country'] = Country::all();
        return response($data, 200);
    }

    public function plates()
    {
        $data = Plate::all();
        return response($data, 200);
    }

    public function citys()
    {
        $data = Location::getViewMain();
        return response($data, 200);
    }

    public function cars()
    {
        $data = Car::all();
        foreach ($data as $var){
            $datas[] = array(
            'id' => $var->id,
            'brand' => Brand::find($var->brand)->brandname,
            'name' => $var->name,
            'year' => $var->year,
            'model' => CarModel::find($var->model)->modelname,
            'fuel' => $var->fuel,
            'transmission' => $var->transmission,
            'default_images' => $var->default_images,
            );
        }

        return response($datas, 200);
    }

    public function languages()
    {
        $data = Language::all();
        return response($data, 200);
    }


}
