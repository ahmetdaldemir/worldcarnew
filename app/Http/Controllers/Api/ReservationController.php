<?php namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Customer;
use App\Models\Ekstra;
use App\Models\Language;
use App\Models\Location;
use App\Models\LocationValue;
use App\Models\Reservation;
use App\Models\ReservationCache;
use App\Models\ReservationEkstra;
use App\Models\ReservationInformation;
use App\Models\ReservationInvoice;
use App\Models\ReservationNote;
use App\Models\Supplier;
use App\Models\TransferZoneFee;
use App\Service\AuthService;
use App\Service\CachePriceCalculate;
use App\Service\Calculate;
use App\Service\CurrencyService;
use App\User;
use Carbon\Carbon;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $supplier = Supplier::where('current_token', $request->token)->first();
        if (!$supplier) {
            $response = ['success' => FALSE, "message" => 'SupplierNotFount'];
            return response($response, 200);
        } else {
            $reservation = Reservation::where("supplier_id", $supplier->id)->get();
            return response($reservation, 200);
        }

    }

    public function datas(Request $request)
    {
        $supplier = Supplier::where('current_token', $request->token)->first();
        if (!$supplier) {
            $response = ['success' => FALSE, "message" => 'SupplierNotFount'];
            return response($response, 200);
        } else {
            // $data['cars'] = Car::all();
            $data['ekstras'] = Ekstra::all();
            $data['center_location_pick_up'] = Location::getViewCenter();
            $data['currency'] = Currency::all();
            $data['country'] = Country::all();
            return response($data, 200);
        }
    }

    public function getDropLocation(Request $request)
    {
        $supplier = Supplier::where('current_token', $request->token)->first();
        if (!$supplier) {
            $response = ['success' => FALSE, "message" => 'SupplierNotFount'];
            return response($response, 200);
        } else {
            $location = array();
            $langId = Language::where("url", app()->getLocale())->first()->id;
            if ($request->id == 0) {
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
            } else {
                $id_location = Location::find($request->id)->id_parent;
                $transferLocation = TransferZoneFee::where("id_location", $id_location)->where("status", 1)->get();
                foreach ($transferLocation as $item) {
                    $locatiValue = LocationValue::where("id_location", $item->id_location_transfer_zone)->where("id_lang", $langId)->first();
                    $location[] = array(
                        'id' => $item->id_location_transfer_zone,
                        'title' => $locatiValue->title,
                        'id_parent' => Location::find($item->id_location_transfer_zone)->id_parent,
                        'type' => $locatiValue->type,
                        'parentList' => Location::join('location_values', 'locations.id', '=', 'location_values.id_location')->select('locations.*', 'location_values.title')->where('locations.id_parent', $item->id_location_transfer_zone)->where('location_values.id_lang', 1)->get(),
                    );
                }
            }
            return $location;
        }
    }

    public function getCars(Request $request)
    {
        $supplier = Supplier::where('current_token', $request->token)->first();
        if (!$supplier) {
            $response = ['success' => FALSE, "message" => 'SupplierNotFount'];
            return response($response, 200);
        } else {
            $response = new Calculate($request);
            return $response->index();
        }
    }

    public function getCustomer(Request $request)
    {
        $supplier = Supplier::where('current_token', $request->token)->first();
        if (!$supplier) {
            $response = ['success' => FALSE, "message" => 'SupplierNotFount'];
            return response($response, 200);
        } else {
            $data = [];
            $customer = Customer::where("firstname", "like", '%' . $request->searchText . '%')->orWhere("lastname", "like", '%' . $request->searchText . '%')->get();
            foreach ($customer as $item) {
                $data[] = array(
                    'id' => $item->id,
                    'firstname' => $item->firstname,
                    'lastname' => $item->lastname,
                    'email' => $item->email,
                    'phone' => $item->phone,
                    'birthday' => Carbon::parse($item->birthday)->format('d-m-Y'),
                    'gender' => $item->gender,
                    'nationality' => $item->nationality,
                    'total_reservation' => $this->get_reservation_for_customer($item->id),
                );
            }
            return response($data, 200);
        }
    }
    public function get_reservation_for_customer($id_customer)
    {

        return  Reservation::where("id_customer",$id_customer)->count();
    }

    public function addcustomer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique|max:255',
            'phone' => 'required|unique|max:255',
            'tc' => 'required|unique|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json("Zorunlu alanları doldurunuz", 422);
        }

        $customer = new Customer();
        $customer->firstname = $request->firstname;
        $customer->lastname = $request->lastname;
        $customer->fullname = $request->fullname;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->gender = $request->gender;
        $customer->birthday = $request->birthday;
        $customer->nationality = $request->nationality;
        $customer->password = bcrypt(rand(111, 999999));
        $customer->tc = $request->tc;
        $customer->birthpalace = $request->birthpalace;
        $customer->language = $request->language;
        $customer->tax_office = $request->tax_office;
        $customer->tax = $request->tax;
        $customer->passport_number = $request->passport_number;
        $customer->passport_palace = $request->passport_palace;
        $customer->passport_date  = $request->passport_date;
        $customer->home_address  = $request->home_address;
        $customer->office_address = $request->office_address;
        $customer->status = 1;
        $customer->save();

        $data  = array(
            'customer_country' => $request->nationality,
            'customer_fullname' => $request->firstname." ".$request->lastname,
            'email' => $request->email,
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'gender' => $request->gender,
        );
        return response()->json(array('success' => true, 'data' => $data), 200);
    }


    public function store(Request $request)
    {
        $customer = Customer::firstOrCreate([
            'email' => $request->email,
            'phone' => $request->phone
        ], [
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'fullname' => $request->fullname,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'birthday' => $request->birthday,
            'nationality' => $request->nationality,
            'password' => bcrypt(rand(111, 999999)),
            'tc' => $request->tc,
            'birthpalace' => $request->birthpalace,
            'language' => $request->language,
            'tax_office' => $request->tax_office,
            'tax' => $request->tax,
            'passport_number' => $request->passport_number,
            'passport_palace' => $request->passport_palace,
            'passport_date'  >= $request->passport_date,
            'home_address'  >= $request->home_address,
            'office_address' => $request->office_address,
            'status' => 1,
        ]);

        $customer_id = $customer->id();

        /*
        $reservationcache = ReservationCache::where('uuid',$this->guestId())->orderBy('id','desc')->first();
        $reservationcachedata = json_decode($reservationcache->value,TRUE);
        $currencyResponse = new CurrencyService( 'EUR_'.$currencies->left_icon);
        $currencyData = $currencyResponse->getCurrency();
        $singlecarpricelocation = new CachePriceCalculate($reservationcachedata,$currencyData,$reservationcachedata['id_car']);
        $x = $singlecarpricelocation->price_Calculate($reservationcachedata['id_car'],$request->id,$this->outside_discount);


        $reservation = new Reservation();
        $reservation->id_customer = $customer_id;
        $reservation->phone = $request->phone_country.$request->tel;
        $reservation->phone2 = $request->phone ?? "1";
        $reservation->driver_license = $request->driving_age ?? "1";
        $reservation->id_language = $request->language_id;
        $reservation->nationality = $request->country ?? "1";
        $reservation->payment_method = $request->method ?? 0; //enum('debit-card','delivery-debit-card','debit-cash','online-credit-card')
        $reservation->total_amount = $x['discount_price'] ?? 0;
        $reservation->rest = $x['discount_price'] ?? 0;
        $reservation->id_currency = $currencies->id;
        $reservation->car = $id_car ?? 0;
        $reservation->day_price = $x['day_price'] ?? 0;
        $reservation->currency_price = $x['currency_data'] ?? 0;
        $reservation->status = Reservation::RESERVATION_STATUS_NEW;
        $reservation->drop_price = $x['drop_price'];
        $reservation->up_price = $x['up_price'];
        $reservation->discount = $x['discount'];
        $reservation->coupon = 0;
        $reservation->rent_price = $x['rent_price'];
        $reservation->days = $x['total_day'];
        $reservation->up_location = $responseData['pick_up_location'];
        $reservation->drop_location = $responseData['end_point'] ?? $responseData['pick_up_location'];
        $reservation->checkin = $responseData['cikis_tarihi_submit'];
        $reservation->checkout = $responseData['donus_tarihi_submit'];
        $reservation->checkin_time = $responseData['cikis_saati_submit']; //$responseData['pick_up_time'];
        $reservation->checkout_time = $responseData['donus_saati_submit']; //$responseData['pick_down_time'];
        $reservation->user_id = 1;
        $reservation->up_date = NULL;
        $reservation->drop_date = NULL;
        $reservation->device = Browser::browserFamily();
        $reservation->it_made = AuthService::activeGuard() ?? "web";
        $reservation->save();

        $lastInsertId = $reservation->id;
        $ekstraArray = $requestdata['ekstra'];
        $ekstratotal = 0;
        if (!empty($ekstraArray)) {
            $i = 0;
            foreach ($ekstraArray as $key => $value) {
                $reservation_ekstras = new ReservationEkstra();
                $ekstra = Ekstra::where("id", $key)->first();
                if ($ekstra->sellType != 'ofRent') {
                    $ekstratotal += round($requestdata['days'] * $ekstra->price * $value[0]) * $currencies->exchange;
                    $itemtotal = round($requestdata['days'] * $ekstra->price * $value[0]) * $currencies->exchange;
                } else {
                    $ekstratotal += round($ekstra->price) * $currencies->exchange * $value[0];
                    $itemtotal = round($ekstra->price) * $currencies->exchange * $value[0];
                }

                $reservation_ekstras->id_reservation = $lastInsertId;
                $reservation_ekstras->id_ekstra = $ekstra->id;
                $reservation_ekstras->item = $value[0];
                $reservation_ekstras->day = $requestdata['days'];
                $reservation_ekstras->item_price = $ekstra->price * $currencies->exchange;
                $reservation_ekstras->price = $itemtotal;
                $reservation_ekstras->save();
                $i++;
            }
        }

        $reservationupdate = Reservation::find($lastInsertId);
        $reservationupdate->ekstra_price = $ekstratotal;
        $reservation->pnr = "PNR" . date('Y') . $lastInsertId;
        $reservationupdate->save();

        $tokenarray = array(
            'id_reservation' => $lastInsertId,
            'id_customer' => $customer_id,
        );
        $key = "worldcar.com";
        $encode = base64_encode(JWT::encode($tokenarray, $key));

        $totalAmount = $hidden['rent_price'] + $ekstratotal + $hidden['drop_price'] + $hidden['up_price'];
        $reservation->comfirm_token = $encode;
        $reservation->total_amount = $totalAmount;
        $reservation->old_total_amount = $totalAmount;
        $reservation->save();

        $reservation_informations = new ReservationInformation();
        $reservation_informations->id_reservation = $lastInsertId;
        $reservation_informations->checkin = $responseData['cikis_tarihi_submit'];
        $reservation_informations->checkout = $responseData['donus_tarihi_submit'];
        $reservation_informations->checkin_time = $responseData['cikis_saati_submit'];
        $reservation_informations->checkout_time = $responseData['donus_saati_submit'];
        $reservation_informations->days = $requestdata['days'];
        $reservation_informations->up_location = $responseData['pick_up_location'];
        $reservation_informations->drop_location = $responseData['end_point'] ?? $responseData['pick_up_location'];
        $reservation_informations->up_drop_information = json_encode($request->info);
        $reservation_informations->firstname = Str::upper($request->firstname);
        $reservation_informations->lastname = Str::upper($request->lastname);
        $reservation_informations->email = $request->email;
        $reservation_informations->phone_country = $request->phone_country;
        $reservation_informations->phone = $request->tel;
        $reservation_informations->nationality = $request->nationality;
        $reservation_informations->birthday = date('Y-m-d', strtotime($request->birthday));
        $reservation_informations->driving_age = $request->driving_age;


        $reservation_informations->save();

        if ($request->description != null) {
            $reservationdescription = new ReservationNote();
            $reservationdescription->id_reservation = $lastInsertId;
            $reservationdescription->sender = 'user';
            $reservationdescription->messages = $request->description;
            $reservationdescription->save();
        }

        $reservation_invoices = new ReservationInvoice();
        $reservation_invoices->id_reservation = $lastInsertId;
        $reservation_invoices->company = 1;
        $reservation_invoices->tax_number = 1;
        $reservation_invoices->tax_office = 1;
        $reservation_invoices->city = 1;
        $reservation_invoices->state = 1;
        $reservation_invoices->country = 1;
        $reservation_invoices->save();
        */
    }

}
