<?php namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Jobs\AccessReportJob;
use App\Jobs\ReservationJob;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Language;
use App\Models\ReservationCache;
use App\Models\ReservationNote;
use App\Repository\Data;
use App\Service\CachePriceCalculate;
use App\Service\CurrencyService;
use App\Service\GetData;
use App\Service\PaymentService;
use App\Service\SingleCarPriceCalculate;
use Browser;
use App\Service\Search;
use App\Helpers\TcApi;
use App\Models\Brand;
use App\Models\Camping;
use App\Models\Car;
use App\Models\CarImage;
use App\Models\CarModel;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Location;
use App\Models\Ekstra;
use App\Models\Reservation;
use App\Models\ReservationEkstra;
use App\Models\ReservationInformation;
use App\Models\ReservationInvoice;
use App\Models\ReservationPayment;
use App\Service\AuthService;
use App\Service\Payment\Vakifbank;
use App\Service\ReservationService;
use Carbon\Carbon;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;
use PDF;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Mail;
use Redis;

class ReservationController extends Controller
{

    protected $language = 1;
    protected $campaing;
    protected $pdfservice;
    public $redis;
    public $outside_discount;
    public $outside_country;


    public function __construct()
    {
        $this->getdata = new GetData();
        $this->campaing = new Camping();
        $this->redis = new Redis();
        $this->redis->connect('localhost', 6379);

        $this->outside_country = $this->localCountry();

        if($this->outside_country != "TR")
        {
            $this->outside_discount = $this->staticData()['countryDiscount'];
        }else{
            $this->outside_discount = 0;
        }

        dispatch(new AccessReportJob());
    }

    public function index(Request $request)
    {

        $responseData = json_decode($this->redis->get($this->cacheResponseId()), true);

        if(is_null($responseData))
        {
            return redirect()->to('/');
        }

        $reservationcache = new ReservationCache();
        $reservationcache->uuid = $this->guestId();
        $reservationcache->value = json_encode(array_merge($request->toArray(), $responseData));
        $reservationcache->save();

        $downLocation = $responseData['end_point'];
        if ($responseData['end_point'] == null) {
            $downLocation = $responseData['pick_up_location'];
        }
        $test = new TcApi("Ahmet", "Daldemir", "1987", "65515072348");
        $car = Car::where("id", $request->id_car)->first();
        $data['car'] = $car;
        $data['currencyExchange'] = Currency::where('right_icon', $request->currency)->first()->exchange;
        $data['static'] = $this->staticData();
        $data["center_location"] = Location::getViewCenter();
        $data["car_camping"] = $this->campaing->handle();
        $data["nowTime"] = Data::getNowTime();
        $data["cars"] = Data::getCarInfoNoYear($request->id_car);
        $data["datas"] = $request;
        $data["category"] = Category::all();
        $data["countries"] = DB::table("countries")->get();
        $data["up_location"] = Location::getViewCenterId($responseData['pick_up_location'])[0]->title;
        $data["down_location"] = Location::getViewCenterId($downLocation)[0]->title;
        $data["ekstra"] = Search::ekstraProcess($request->ekstra, $data['currencyExchange']);
        $data["ekstraTotal"] = $this->getdata->calculateEkstra($request->ekstra, $request->days, $data['currencyExchange']);
        $data["pickupType"] = Search::getOperationType($responseData['pick_up_location']);
        $data["dropType"] = Search::getOperationType($downLocation);
        $data["checkoutImage"] = Data::getPageImage("checkout");
        $data["reservationOptions"] = $responseData;
        $data["discount"] = base64_decode($request->discount);
        $data["drop_date"] = $this->redis->get('down_date');
        $this->redis->set("ekstra", json_encode($request->ekstra));
        $this->redis->set("id_car", $request->id_car);

        Session::put("id_car", $request->id_car);
        Session::put("responseData", json_encode($responseData));
        Session::put("requestdata", $request->request->all());

        return view('view.reservation', ['data' => $data]);
    }

    public function campainreservation(Request $request)
    {

        $pick_down_location1 = $request->pick_down_location1;
        if ($request->pick_down_location1 == 0) {
            $pick_down_location1 = $request->pick_up_location1;
        }
        $days = Search::customDifference($request->up_location, $request->down_location);
        $test = new TcApi("Ahmet", "Daldemir", "1987", "65515072348");
        $car = Car::where("id", $request->id_car)->first();
        $data['currencyExchange'] = Currency::find($request->currency)->exchange;
        $data['static'] = $this->staticData();
        $data["center_location"] = Location::getViewCenter();
        $data["car_camping"] = $this->campaing->handle();
        $data["nowTime"] = Data::getNowTime();
        $data["cars"] = Brand::where("id", $car->brand)->first()->brandname . " " . CarModel::where("id", $car->model)->first()->modelname;
        $data["car_image"] = CarImage::where("id_car", $request->id_car)->take(1)->get();
        $data["datas"] = $request;
        $data["car"] = $car;
        $data["category"] = Category::all();
        $data["countries"] = DB::table("countries")->get();
        $data["up_location"] = Location::getViewCenterId($request->pick_up_location1)[0]->title;
        $data["down_location"] = Location::getViewCenterId($pick_down_location1)[0]->title;
        $data["ekstra"] = Search::ekstraProcess($request->ekstra, $data['currencyExchange']);

        $data["ekstraTotal"] = $this->getdata->calculateEkstra($request->ekstra, $request->days, $data['currencyExchange']);

        $data["pickupType"] = Search::getOperationType($request->pick_up_location1);
        $data["dropType"] = Search::getOperationType($pick_down_location1);
        $data["reservationOptions"] = $request;
        $data["checkoutImage"] = "reservationbanner.png";


        Session::put("responseData", json_encode($request));

        return view('view.reservation', ['data' => $data]);
    }

    public function checkout(Request $request)
    {

        // $responseData = json_decode($this->redis->get($this->cacheResponseId()), true);
       // dd($responseData);
        $responseData = json_decode(Session::get("responseData"), true);
        $requestdata = Session::get('requestdata');

        $languageId = Language::where('url', app()->getLocale())->first()->id;


        $id_car = Session::get('id_car');
        $hidden = Crypt::decrypt($requestdata['hidden']);
        $this->redis->set("user_language", app()->getLocale());
        $checkcustomer = $this->checkcustomer($request->email);
        if ($checkcustomer == 0) {
            $password = rand(1111, 9999);
            $passwordhash = bcrypt($password);
        } else {
            $password = "*****";
        }

        $country =  Country::where("country_name",$request->nationality)->first();

        $phone  = Helper::replacePhone($country,$request->tel);


        if ($checkcustomer == 0) {
            $customer = new Customer();
            $customer->firstname = Str::upper($request->firstname);
            $customer->lastname  = Str::upper($request->lastname);
            $customer->fullname  = Str::upper($request->firstname) . " " . Str::upper($request->lastname);
            $customer->email     = $request->email;
            $customer->phone     = $phone;
            $customer->phone1    = $request->phone;
            $customer->gender    = $request->gender;
            $customer->phone_country = $request->phone_country;
            $customer->birthday    = date('Y-m-d', strtotime($request->birthday));
            $customer->nationality = $request->nationality;
            $customer->language    = $languageId;
            $customer->password    = $passwordhash;
            $customer->save();
            $checkcustomer = $customer->id;
        } else {
            $customer = Customer::find($checkcustomer);
            $customer->language = $languageId;
            $customer->firstname = Str::upper($request->firstname);
            $customer->lastname  = Str::upper($request->lastname);
            $customer->fullname  = Str::upper($request->firstname) . " " . Str::upper($request->lastname);
            $customer->email     = $request->email;
            $customer->phone     = $phone;
            $customer->phone1    = $request->phone;
            $customer->gender    = $request->gender;
            $customer->phone_country = $request->phone_country;
            $customer->birthday    = date('Y-m-d', strtotime($request->birthday));
            $customer->nationality = $request->nationality;
            $customer->save();
        }


        $customer_id = $checkcustomer;

        $currencies = Currency::where("right_icon", $requestdata['currency'])->first();
        $user_language_id = $languageId;


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
        $reservation->id_language = $user_language_id;
        $reservation->nationality = $request->country ?? "1";
        $reservation->payment_method = $request->method ?? 0;
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

        /*
        if ($request->method == "online-credit-card") {

            $cardHolder = array(
                'name' => "Ahmet DALDEMİR",
                'cardnumber' => $request->cardnumber,
                'exp_date_mounth' => $request->exp_date_mounth,
                'exp_date_year' => $request->exp_date_year,
                'cvc' => $request->cvv,
                'price' => "1.00", //$requestdata['last_price'],
                'pnr' => $reservation->pnr . 'I' . rand(11111, 99999),
            );

            $x = new PaymentService($cardHolder);

            $reservation_payments = new ReservationPayment();
            $reservation_payments->id_reservation = $lastInsertId;
            $reservation_payments->credit_card = 'DSADA';
            $reservation_payments->card_number = $request->cardnumber;
            $reservation_payments->card_date = $request->exp_date_mounth . "" . $request->exp_date_year;
            $reservation_payments->message = $x;
        } else {
            echo "1";
        }
        */
        $data['static'] = $this->staticData();


        $redissenddata = array('reservation' => $reservation, 'password' => $password, 'user_language_id' => $user_language_id);
        $this->redis->set($this->guestId(), json_encode($redissenddata));
        ReservationJob::dispatch()->delay(now()->addMinutes(2));
        return redirect()->route('voucher', [app()->getLocale(), 'id' => $reservation]);
    }

    public function voucher(Request $request)
    {
        $reservation = new ReservationService();
        $data['static'] = $this->staticData();
        $reservationData = $reservation->get_data($request->id);
        return view('view.voucher', ['data' => $data, 'reservation' => $reservationData]);
    }

}
