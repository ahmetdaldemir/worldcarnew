<?php

namespace App\Http\Controllers\Admin;

use App\Admin\PlateDocument;
use App\Enums\EmailStatus;
use App\Http\Controllers\Controller;
use App\Jobs\ReservationJob;
use App\Jobs\SendMailSurveyJob;
use App\Jobs\Survey;
use App\Models\BlackList;
use App\Models\Brand;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\Category;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Customer;
use App\Models\Ekstra;
use App\Models\EmailTemplate;
use App\Models\Language;
use App\Models\Location;
use App\Models\LocationValue;
use App\Models\Plate;
use App\Models\Reservation;
use App\Models\ReservationEkstra;
use App\Models\ReservationEmail;
use App\Models\ReservationInformation;
use App\Models\ReservationInvoice;
use App\Models\ReservationLog;
use App\Models\ReservationNote;
use App\Models\ReservationOperation;
use App\Models\ReservationPayment;
use App\Models\ReservationPlate;
use App\Models\ReservationRest;
use App\Models\SystemLogs;
use App\Repositories\Log\LogRepositoryInterface;
use App\Repositories\Plate\PlateRepositoryInterface;
use App\Repositories\Reservation\ReservationRepositoryInterface;
use App\Repositories\Survey\SurveyRepositoryInterface;
use App\Service\AuthService;
use App\Service\CheckPlate;
use App\Service\Dashboard\Comeback;
use App\Service\EkstraCalculate;
use App\Service\PdfRevisionService;
use App\Service\PdfService;
use App\Service\Reservation\TotalCalculate;
use App\Service\SingleCarPriceCalculate;
use App\Traits\HasErrors;
use App\Traits\ReservationLogTrait;
use App\User;
use App\Repository\Data;
use App\Service\Calculate;
use App\Service\CurrencyService;
use App\Service\Payment\Vakifbank;
use Carbon\Carbon;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use App\Helpers\Search;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Redis;
use DB;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class ReservationController extends Controller
{
    use HasErrors, ReservationLogTrait;

    const comfirm = 'Onay Maili Gönderdi';
    const closed = 'Red  Maili Gönderdi';
    const comfirm_please = 'Tekrar Comfirme Ediniz  Maili Gönderdi';
    const reservation_edit = 'Geliş Dönüş Bilgilerini Giriniz  Maili Gönderdi';
    const reservation_normal = 'Normal mail gönderildi';
    const up = 'Çıkış İşlemi Yaptı';
    const drop = 'Dönüş İşlemi Yaptı';

    public const EMAIL_STATUS = [
        'comfirm' => ReservationController::comfirm,
        'closed' => ReservationController::closed,
        'comfirm_please' => ReservationController::comfirm_please,
        'reservation_edit' => ReservationController::reservation_edit,
        'normal' => ReservationController::reservation_normal,
    ];

    public const OPERATION_STATUS = [
        'up' => ReservationController::up,
        'drop' => ReservationController::drop,
    ];
    public Redis $redis;

    protected Data $data;
    protected Location $location;
    protected LogRepositoryInterface $logRepositoryInt;
    private PlateRepositoryInterface $plateRepository;
    private ReservationRepositoryInterface $reservationRepository;
    private Comeback $comeback;

    public function __construct(LogRepositoryInterface         $logRepositoryInt,
                                PlateRepositoryInterface       $plateRepository,
                                ReservationRepositoryInterface $reservationRepository,
                                SurveyRepositoryInterface      $surveyRepository
    )
    {
        $this->plateRepository = $plateRepository;
        $this->reservationRepository = $reservationRepository;
        $this->surveyRepository = $surveyRepository;
        $this->search = new Search();
        $this->data = new Data();
        $this->location = new Location();
        $this->logRepositoryInt = $logRepositoryInt;
        $this->redis = new Redis();
        $this->comeback = new Comeback();

        $this->redis->connect('localhost', 6379);
    }

    public function index($page = null)
    {
        $reservation = $this->reservationRepository->getindex();
        $x = new TotalCalculate($reservation);
        $totalcalculate = $x->handle();

        $reservationlog = "";
        $brands = Brand::select('id', 'brandname')->get();
        $models = CarModel::all();
        $customers = DB::table('customers')->select('id', 'fullname')->get();
        $request = "";
        $currencies = Currency::all();
        $breadcrumbs = "Rezervasyonlar";
        $categorys = Category::all();
        $locationView = Location::getViewMain();

        return view('admin.reservation.index', compact('categorys', 'breadcrumbs', 'reservation', 'reservationlog', 'brands', 'models', 'customers', 'request', 'totalcalculate', 'currencies','locationView'));
    }

    public function deletereservation()
    {
        $data['reservation'] = $this->reservationRepository->getdelete();
        $data['reservationlog'] = "";
        $data['brands'] = Brand::all();
        $data['models'] = CarModel::all();
        $data['request'] = "";
        $data['customers'] = DB::table('customers')->select('id', 'fullname')->get();
        $data['currencies'] = Currency::all();
        $data['breadcrumbs'] = "Silinen Rezervasyonlar";
        $data["categorys"] = Category::all();
        $x = new TotalCalculate($data['reservation']);
        $data['totalcalculate'] =   $x->handle();
        $data['locationView'] = Location::getViewMain();

        return view('admin.reservation.index', $data);
    }

    public function customerreservation($id)
    {
        $data['reservation'] = $this->reservationRepository->getcustomer($id);
        $data['reservationlog'] = "";
        $data['brands'] = Brand::all();
        $data['models'] = CarModel::all();
        $data['request'] = "";
        $data['customers'] = DB::table('customers')->select('id', 'fullname')->get();
        $data['currencies'] = Currency::all();
        $data['breadcrumbs'] = "Müşteri Rezervasyonları";
        $data["categorys"] = Category::all();
        $x = new TotalCalculate($data['reservation']);
        $data['totalcalculate'] =   $x->handle();
        $data['locationView'] = Location::getViewMain();

        return view('admin.reservation.index', $data);
    }

    public function cancelreservation()
    {
        $data['reservation'] = $this->reservationRepository->getstatus('closed');
        $data['reservationlog'] = "";
        $data['brands'] = Brand::all();
        $data['models'] = CarModel::all();
        $data['request'] = "";
        $data['customers'] = DB::table('customers')->select('id', 'fullname')->get();
        $data['currencies'] = Currency::all();
        $data['breadcrumbs'] = "İptal Edilen Rezervasyonlar";
        $data["categorys"] = Category::all();
        $x = new TotalCalculate($data['reservation']);
        $data['totalcalculate'] =   $x->handle();
        $data['locationView'] = Location::getViewMain();

        return view('admin.reservation.index', $data);
    }

    public function noncomfirmreservation()
    {
        $data['reservation'] = $this->reservationRepository->getnoncomfirm('waiting');
        $data['reservationlog'] = "";
        $data['brands'] = Brand::all();
        $data['models'] = CarModel::all();
        $data['request'] = "";
        $data['customers'] = DB::table('customers')->select('id', 'fullname')->get();
        $data['currencies'] = Currency::all();
        $data['breadcrumbs'] = "Onaylanmayan Rezervasyonlar";
        $data["categorys"] = Category::all();
        $x = new TotalCalculate($data['reservation']);
        $data['totalcalculate'] =   $x->handle();
        $data['locationView'] = Location::getViewMain();

        return view('admin.reservation.index', $data);
    }

    public function newreservation()
    {
        $data['reservation'] = $this->reservationRepository->getnewcomfirm();
        $data['reservationlog'] = "";
        $data['brands'] = Brand::all();
        $data['models'] = CarModel::all();
        $data['request'] = "";
        $data['customers'] = DB::table('customers')->select('id', 'fullname')->get();
        $data['currencies'] = Currency::all();
        $data['breadcrumbs'] = "Yeni Rezervasyonlar";
        $data["categorys"] = Category::all();
        $x = new TotalCalculate($data['reservation']);
        $data['totalcalculate'] =   $x->handle();
        $data['locationView'] = Location::getViewMain();

        return view('admin.reservation.index', $data);
    }

    public function waitupreservation()
    {
        $data['reservation'] = $this->comeback->totalUpList();
        $data['reservationlog'] = "";
        $data['brands'] = Brand::all();
        $data['models'] = CarModel::all();
        $data['request'] = "";
        $data['customers'] = DB::table('customers')->select('id', 'fullname')->get();
        $data['breadcrumbs'] = "Beklemede Olan Rezervasyonlar";
        $data['currencies'] = Currency::all();
        $data["categorys"] = Category::all();
        $x = new TotalCalculate($data['reservation']);
        $data['totalcalculate'] =   $x->handle();
        $data['locationView'] = Location::getViewMain();

        return view('admin.reservation.index', $data);
    }

    public function checked(Request $request)
    {
        $reservation = Reservation::find($request->id);
        $reservation->status = 'comfirm';
        $reservation->save();
        return redirect()->to('admin/admin/reservation/edit?id=' . $request->id . '');
    }

    public function statusChange(Request $request)
    {
        $reservation = Reservation::find($request->id);
        $reservation->status = $request->status;
        $reservation->save();

        if ($reservation->plate != null) {
            if ($request->status == "closed") {
                $plate = Plate::find($reservation->plate);
                $plate->status = Plate::PLATE_STATUS_FREE;
                $plate->save();
            }
        }
        $log = [
            'name' => $request->status . "Durum Değiştirildi"
        ];
        $this->saveLogReservation('statuschange', $reservation->id, $log);
        return response()->json(['status' => 200]);
    }

    public function create()
    {
        $data['cars'] = Car::all();
        $data['ekstras'] = Ekstra::where('status', "1")->get();
        $data['center_location_pick_up'] = Location::getViewCenter();
        $data['currency'] = Currency::all();
        $data['country'] = Country::all();
        $data['languages'] = Language::all();
        return view('admin.reservation.create', $data);
    }

    public function survey_answers()
    {
        $survey_answers = $this->surveyRepository->all();
        return view('admin.reservation.survey_answers', compact('survey_answers'));
    }

    public function save(Request $request)
    {

        $currency = new CurrencyService($request->currency);
        $this->currency_data = $currency->getCurrency();

        $currency = explode("_", $request->currency);
        $currency_data = Currency::where("left_icon", $currency[1])->first();

        $totalprice = $request->totalprice;
        $discount = 0;
        if ($request->totalprice != $request->discount && $request->discount > 0) {
            $discount = 100 - (($request->discount * 100) / $request->totalprice);
            $totalprice = $request->discount;
        }

        $customer = Customer::find($request->id_customer);


        $reservation = new Reservation();
        $reservation->id_customer = $request->id_customer;
        $reservation->day_price = $request->day_price;
        $reservation->up_price = $request->up_price;
        $reservation->drop_price = $request->drop_price;
        $reservation->rent_price = $request->rent_price;
        $reservation->discount = $discount;
        $reservation->total_amount = $totalprice;
        $reservation->old_total_amount = $totalprice;
        $reservation->ekstra_price = $request->ekstra_total;
        $reservation->car = $request->id_car;
        $reservation->days = $request->days;
        $reservation->currency_price = $request->currency_price;
        $reservation->plate = $request->id_plate;
        $reservation->id_currency = $currency_data->id;
        $reservation->payment_method = $request->payment_method;
        $reservation->id_language = $customer->language;
        $reservation->coupon = 0;
        $reservation->phone2 = $customer->phone ?? 0; // Set edilecek
        $reservation->driver_license = 1; //kontrol edilecek
        $reservation->status = Reservation::RESERVATION_STATUS_NEW;
        $reservation->rest = $totalprice;
        //$reservation->up_location = $request->up_location;
        //$reservation->drop_location = $request->drop_location;
        $reservation->up_location = $request->up_location; //Location::getLanguageValueForLangWithParentId($request->up_location,$customer->language)->id;
        $reservation->drop_location = $request->drop_location; //Location::getLanguageValueForLangWithParentId($request->drop_location,$customer->language)->id;
        $reservation->checkin = date('Y-m-d', strtotime($request->up_date));
        $reservation->checkout = date('Y-m-d', strtotime($request->drop_date));
        $reservation->checkin_time = $request->up_time;
        $reservation->checkout_time = $request->drop_time;
        $reservation->nationality = $customer->nationality;
        $reservation->reservation_source = $request->reservation_source;
        $reservation->user_id = Auth::id();
        $reservation->it_made = AuthService::activeGuard() ?? "web";
        $reservation->save();
        $id_last_reservation = $reservation->id;
        $ekstratotal = 0;
        foreach ($request->ekstra as $ekstra) {

            $reservationonekstramodel = new ReservationEkstra();

            $ekstramodel = Ekstra::where("id", $ekstra['id'])->first();
            if ($ekstramodel->sellType == 'daily') {
                $ekstratotal += round($request->days * $ekstramodel->price * $ekstra['value']) * $currency_data->exchange;
                $itemtotal = round($request->days * $ekstramodel->price * $ekstra['value']) * $currency_data->exchange;
            } else {
                $ekstratotal += round($ekstramodel->price) * $currency_data->exchange * $ekstra['value'];
                $itemtotal = round($ekstramodel->price) * $currency_data->exchange * $ekstra['value'];
            }

            $reservationonekstramodel->id_reservation = $id_last_reservation;
            $reservationonekstramodel->id_ekstra = $ekstra['id'];
            $reservationonekstramodel->day = $request->days;
            $reservationonekstramodel->item = $ekstra['value'];
            $reservationonekstramodel->item_price = $ekstramodel->price * $currency_data->exchange;
            $reservationonekstramodel->price = $itemtotal;
            $reservationonekstramodel->save();
        }


        $reservation_informations = new ReservationInformation();
        $reservation_informations->id_reservation = $id_last_reservation;
        $reservation_informations->checkin = date('Y-m-d', strtotime($request->up_date));
        $reservation_informations->checkout = date('Y-m-d', strtotime($request->drop_date));
        $reservation_informations->checkin_time = date('H:i', strtotime($request->up_time));
        $reservation_informations->checkout_time = date('H:i', strtotime($request->drop_time));
        $reservation_informations->days = $request->days;
        $reservation_informations->up_location = $request->up_location;
        $reservation_informations->drop_location = $request->drop_location;
        $reservation_informations->up_drop_information = json_encode($request->info);
        $reservation_informations->firstname = $customer->firstname;
        $reservation_informations->lastname = $customer->lastname;
        $reservation_informations->email = $customer->email;
        $reservation_informations->phone = $customer->phone;
        $reservation_informations->nationality = $customer->nationality;
        $reservation_informations->save();


        $reservation_invoices = new ReservationInvoice();
        $reservation_invoices->id_reservation = $id_last_reservation;
        $reservation_invoices->company = 1;
        $reservation_invoices->tax_number = 1;
        $reservation_invoices->tax_office = 1;
        $reservation_invoices->city = 1;
        $reservation_invoices->state = 1;
        $reservation_invoices->country = 1;
        $reservation_invoices->save();


        if ($request->get('method') == "online-credit-card") {
            $reservation_payments = new ReservationPayment();
            $reservation_payments->id_reservation = $id_last_reservation;
            $reservation_payments->credit_card = 'DSADA';
            $reservation_payments->card_number = 'DSADA';
            $reservation_payments->card_date = 'DSADA';
            $reservation_payments->message = 'DSADA';

            $x = new Vakifbank($request);
            dd($x->getContent());
        }

        $tokenarray = array(
            'id_reservation' => $id_last_reservation,
            'id_customer' => $request->id_customer,
        );
        $key = "worldcar.com";
        $encode = base64_encode(JWT::encode($tokenarray, $key));

        $reservation->comfirm_token = $encode;
        $reservation->pnr = "PNR" . date('Y') . $id_last_reservation;
        $reservation->save();


        $newplate = Plate::find($reservation->plate);
        $newplate->status = Plate::PLATE_STATUS_BUSY;
        $newplate->save();

        $newreservation = Reservation::find($id_last_reservation);

        $data['static'] = $this->staticData();
//      $this->dispatch(new \App\Jobs\SendMailJob($reservation));

        $redissenddata = array('reservation' => $reservation, 'password' => "", 'user_language_id' => $customer->language);
        $this->redis->set($request->_token, json_encode($redissenddata));
        ReservationJob::dispatch(0)->delay(now()->addMinutes(2));

        $log = [
            'Başlık' => $request->status . "Durum Değiştirildi",
            'fiyat' => $totalprice . " => " . $request->totalprice,
            'kur' => $currency_data->id
        ];
        $this->saveLogReservation('newreservation', $reservation->id, $log);

        return redirect('admin/admin/reservation/index/status?status=0');
    }

    public function show($id)
    {
        //
    }

    public function operation()
    {
        $car = Car::orderBy('id')->get();
        $plates = Plate::where('status', Plate::PLATE_STATUS_FREE)->get();
        return view('admin.reservation.operation', ['car' => $car, 'plates' => $plates]);
    }

    public function kmcontrol(Request $request)
    {
        $id = $request->id;
        $reservation = Reservation::find($id);
        $km = $request->km;
        $reservationoperation = ReservationOperation::where('type', 'drop')->where('id_reservation', $id)->first();
        if ($reservationoperation->km > $km) {
            return "Yanlış Km Giriyorsunuz";
        }
        $diffkm = $km - $reservationoperation->km ?? 0;
        if ($reservation->days < 14) {
            $newkm = $reservation->days * 300;

            if ($diffkm > $newkm) {
                return $diffkm . "KM Aşım Yapıldı";
            }
        } else {
            if ($diffkm > 10000) {
                return "1000 KM üzeri Giriş Yapıldı";
            }
        }
    }

    public function edit(Request $request)
    {

        $reservation = Reservation::find($request->id);
        if (!$request) {
            return redirect()->back();
        }
        if(!$reservation->reservationInformation)
        {
            return redirect('admin.admin.reservation');
        }
        $user = User::all();
        $currencies = Currency::all();
        $plates = $this->plateRepository->getAvaibleAll($reservation);

        $ekstraproduct = Ekstra::all();
        $center_location_pick_up = Location::getViewCenter();
        $reservationoperation = ReservationOperation::where('id_reservation', $request->id)->get();
        $reservationlog = $this->get_log_list($request->id);
        return view('admin.reservation.edit', ['reservation' => $reservation, 'users' => $user, 'plates' => $plates,
            'ekstraproduct' => $ekstraproduct,
            'center_location_pick_up' => $center_location_pick_up, 'reservationoperations' => $reservationoperation, 'reservationlog' => $reservationlog,
            'currencies' => $currencies]);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function delete(Request $request)
    {
        $reservation = Reservation::find($request->id);
        if ($reservation->plate != null) {
            if ($reservation->status != "complated") {
                $plate = Plate::find($reservation->plate);
                $plate->status = Plate::PLATE_STATUS_FREE;
                $plate->save();
            }
        }
        $reservation->status = 'closed';
        $reservation->save();
        $reservation->delete($request->id);
        return redirect()->back();
    }

    public function forceDeletereservation(Request $request)
    {
        $reservation = Reservation::find($request->id);
        if ($reservation->plate != null) {
            if ($reservation->status != "complated") {
                $plate = Plate::find($reservation->plate);
                $plate->status = Plate::PLATE_STATUS_FREE;
                $plate->save();
            }
        }

        $reservation->forceDelete();
        return redirect()->back();
    }

    public function returnback(Request $request)
    {
        Reservation::find($request->id)->restore();
        return redirect()->to('admin/admin/reservation/edit?id=' . $request->id . '');
    }

    public function process(Request $request)
    {

        $imagename = [];
        $reservationoperationresponse = ReservationOperation::where('id_reservation', $request->id)->get();
        if ($reservationoperationresponse) {
            $drop = $reservationoperationresponse->where('type', 'drop')->first();
            if (!$drop && $request->type == 'up') {
                return redirect()->back()->withErrors(['msg' => $request->id . " - Çıkış Yapılmamış"]);
            }
            $check = $reservationoperationresponse->where('type', $request->type)->first();
            if ($check) {
                return redirect()->back()->withErrors(['msg' => $request->id . " - Çıkış Dönüş Yapıldı"]);
            }
        }
        $reservation = Reservation::find($request->id);

        if (is_null($reservation)) {
            return redirect()->back()->withErrors(['msg' => $request->id . " - Rezervasyon Bulunamadı"]);
        }
        if ($reservation->plate == null) {
            return redirect()->back()->withErrors(['msg' => $request->id . " - Plaka Atanmamış"]);
        }

        $plate = Plate::find($reservation->plate);
        if (!is_null($reservation->plate)) {
            if ($request->file('file') != "") {

                foreach ($request->file('file') as $file) {
                    $name = rand(1, 99999) . "_" . time() . '.' . $file->extension();
                    $file->move(storage_path('app/public/reservation_history'), $name);
                    $imagename[] = $name;
                }
            }

            $reservationoperation = new ReservationOperation();
            $reservationoperation->id_reservation = $request->id;
            $reservationoperation->type = $request->type;
            $reservationoperation->km = $request->km;
            $reservationoperation->fuel = $request->fuel;
            $reservationoperation->files = json_encode($imagename);
            $reservationoperation->id_user = $request->id_user;
            $reservationoperation->save();


            if ($request->type == 'up') {
                $plate->status = Plate::PLATE_STATUS_FREE;
                $plate->oil_km_current = $request->km;
                $plate->save();

                $reservation->up_date = Carbon::now()->format('Y-m-d');
                $reservation->status = Reservation::RESERVATION_STATUS_COMPLATE;
                $reservation->save();

                $operationtype = "operationup";

                if (filter_var($reservation->customer->email, FILTER_VALIDATE_EMAIL)) {
                    $this->dispatch(new \App\Jobs\Survey($reservation));
                }

            }

            if ($request->type == 'drop') {
                $plate->status = Plate::PLATE_STATUS_BUSY;
                $plate->save();

                $reservation->drop_date = Carbon::now()->format('Y-m-d');
                $reservation->save();

                $operationtype = "operationdrop";
            }


            $log = [
                'Başlık' => "Operasyon İşlemi Yapıldı",
                'Tip' => $operationtype,
                'Km' => $request->km,
                'Fuel' => $request->fuel,
            ];
            $this->saveLogReservation($operationtype, $reservation->id, $log);

        }

        if ($request->type == "up") {
            $type = "Dönüş İşlemi Yapıldı";
        } else {
            $type = "Çıkış İşlemi Yapıldı";
        }

        return redirect()->back()->withErrors(['msg' => $type]);;
    }

    public function addplate(Request $request)
    {
        $reservation = Reservation::find($request->id);
        $plate = Plate::find($request->plate);

        if (($reservation->plate != '0') && isset($reservation->plate)) {
            $newplate = Plate::find($reservation->plate);
            $newplate->status = Plate::PLATE_STATUS_FREE;
            $newplate->save();
        }

        $busyreservation = Reservation::where('plate', $request->plate)->where('checkout', '<=', $reservation->checkout)->where('checkin', '>=', $reservation->checkin)->count();

        if ($request->plate == 0) {
            $message = "Plaka Seçiniz";
            return redirect()->back()->with('msg', $message);
        }

        if ($request->plate != 0 && $busyreservation == 0) {  //$plate->status == Plate::PLATE_STATUS_FREE

            $reservation->plate = $request->plate;
            $reservation->save();

            $plate->status = Plate::PLATE_STATUS_BUSY;
            $plate->save();

            $reservationplate = new ReservationPlate();
            $reservationplate->id_reservation = $request->id;
            $reservationplate->id_plate = $request->plate;
            $reservationplate->id_user = Auth::id();
            $reservationplate->save();

            $message = "Plaka Atandı";

            $pdf = new PdfRevisionService($reservation);

        } else {
            $message = "Plaka Kullanılabilir Durumda Değil";
        }


        //return redirect()->route('admin.admin.reservation',['status'=> 0])->with('msg', $message);
        return redirect()->back()->with('msg', $message);
    }

    public function changedays(Request $request)
    {

        $rest  = 0;
        $reservation = Reservation::find($request->id);

        $newtime = $request->time1 . ":" . $request->time2 . ":00";

        $checkplate = new CheckPlate();
        $plateresponse =  $checkplate->getId($reservation,$request->checkout,$newtime);

        if($plateresponse == 0)
        {
            return redirect()->back()->withErrors(['msg' => 'Bu araç için başka rezervayona atama yapılmıştır.']);
        }

        $olddays = $reservation->days;
        $olddates = $reservation->checkin . "/" . $reservation->checkin_time . " - " . $reservation->checkout . "/" . $reservation->checkout_time;
        $reservationinfo = ReservationInformation::where('id_reservation', $request->id)->first();
        $reservationnote = new ReservationNote();
        $checkputdays = Carbon::parse($request->checkout)->format('Y-m-d');
        $newdays = $this->search->getCustomDateTimeDiff($reservationinfo->checkin, $checkputdays, $reservationinfo->checkin_time, $newtime);

        if ($request->note != null) {
            $reservationnote->id_reservation = $request->id;
            $reservationnote->sender = 'user';
            $reservationnote->type = 'notes';
            $reservationnote->messages = $request->note;
            $reservationnote->save();
        }

        $reservationinfo->days = $newdays;
        $reservationinfo->checkout = $checkputdays;
        $reservationinfo->checkout_time = $newtime;
        $reservationinfo->save();

        $reservation->days = $newdays;
        $reservation->checkout = $checkputdays;
        $reservation->checkout_time = $newtime;
        $reservation->total_amount += $request->price;
        if (empty($request->rest)) {
            $reservation->rest += $request->price;
            $rest  = 1;
        }

        $reservationrest = new ReservationRest();
        $reservationrest->id_reservation = $request->id;;
        $reservationrest->price = $request->price;
        $reservationrest->type = "out";
        $reservationrest->currency = $request->id_currency;
        $reservationrest->rest = $rest;
        $reservationrest->save();


        if (isset($request->note) and $request->note != null) {
            $reservation->note = $request->price;
        }
        $reservation->save();
        $newdates = $request->checkin . "/" . $request->time1 . " - " . $request->checkout . "/" . $request->time2;
        $log = [
            'Başlık' => "Gün Değişikliği İşlemi Yapıldı",
            'Yeni Gün' => $newdays,
            'Eski Gün' => $olddays,
            'Eski Tarih' => $olddates,
            'Yeni Tarih' => $newdates,
        ];
        $this->saveLogReservation('daychange', $reservation->id, $log);

        return redirect()->back();
    }

    public function get_data(Request $request)
    {
        $response = new Calculate($request);
        return $response->index();
    }

    public function informationrender($up, $drop)
    {
        $up_type = Location::find($up)->type;
        if ($drop == 0) {
            $drop_type = $up_type;
        } else {
            $drop_type = Location::find($drop)->type;
        }
        return array('up_type' => $up_type, 'drop_type' => $drop_type);
    }

    public function get_operation(Request $request)
    {

        $this->redis->set("operationRequest", $request);

        $reservationdata = array();
        $query = Reservation::whereNull('deleted_at')->where("status", '!=', "closed")->where('test', 1);

        if ($request->type == "in") {
            if ($request->has('date_time_first')) {
                $query->whereBetween('checkin', [Carbon::parse($request->date_time_first)->format('Y-m-d'), Carbon::parse($request->date_time_last)->format('Y-m-d')])->orderBy('checkin', 'asc')->orderBy('checkin_time', 'asc');
            }
        }
        if ($request->type == "out") {
            if ($request->has('date_time_last')) {
                $query->whereBetween('checkout', [Carbon::parse($request->date_time_first)->format('Y-m-d'), Carbon::parse($request->date_time_last)->format('Y-m-d')])->orderBy('checkout', 'asc')->orderBy('checkout_time', 'asc');
            }
        }

        if ($request->payment_method && !empty($request->payment_method)) {
            $query->where('payment_method', '=', $request->payment_method);
        }

        if ($request->reservation_status && !empty($request->reservation_status)) {
            $query->where('status', '=', $request->reservation_status);
        }


        if ($request->plate != 2) {
            if ($request->plate != 0) {
                $query->whereNotNull('plate');
            } else {
                $query->whereNull('plate');
            }
        }


        if ($request->car && !empty($request->car)) {
            $query->where('car', '=', $request->car);
        }
        if ($request->city_id && !empty($request->city_id)) {
            $query->where('up_location', '=', $request->city_id);
        }


//        $reservationoperation = ReservationOperation::whereIn('type', array('up', 'drop'))->pluck('id_reservation')->toArray();
//        $arrays = array_count_values($reservationoperation);
//        foreach ($arrays as $key => $value)
//        {
//              if($value == 2)
//              {
//                  $ids[] = $key;
//              }
//        }
//        $x = $query->whereNotIn('id',$ids)->get();

        $x = $query->get();

        foreach ($x as $item) {

            if ($item->plate == null) {
                $carinfo = $this->data->getCarInfoFullNoYear($item->car);
                $carinfodetail = $this->data->getCarInfoFullNoDetail($item->car);
            } else {
                $carinfo = $item->getPlate->car->brandfunction->brandname . " " . $item->getPlate->car->modelfunction->modelname;
                $carinfodetail = $item->getPlate->car->fuel . " " . $item->getPlate->car->transmission;
            }

            $reservationdata[] = array(
                'id' => $item->id,
                'pnr' => $item->pnr,
                'customer_fullname' => $item->customer,
                'car_info' => $carinfo,
                'car_info_detail' => $carinfodetail,
                'car_plate' => $this->data->getPlateReservation($item->plate),
                'checkin' => $item->checkin,
                'checkout' => $item->checkout,
                'checkintime' => $item->reservationInformation->checkin_time ?? NULL,
                'checkouttime' => $item->reservationInformation->checkout_time ?? NULL,
                'day_price' => $item->day_price,
                'days' => $item->days,
                'ekstra_price' => $item->ekstra_price,
                'total_amount' => $item->total_amount,
                'rest' => $item->rest,
                'up_location' => $item->up_location,
                'currency_icon' => Currency::find($item->id_currency)->right_icon,
                'payment_method' => $item->getPaymentMethod(),
                'location' => $this->operationlocationinformation($item->up_location, $item->drop_location),
                //'locationParent' => $this->location->getViewCenterParentId($item->up_location),
                'note' => $item->reservationNotes,
                'reservationStatus' => $item->getReservationStatus(),
                'reservationStatusClass' => $item->getReservationStatusClass(),
                'reservationInfo' => $item->reservationInformation,
                'reservationInfoUp' => json_decode($item->reservationInformation->up_drop_information, TRUE),
                'tdcolor' => $this->tdcolor($item->id, $request->type),
                'is_letter' => $this->islettetcolor($item->is_letter),
                'plate' => $item->plate ? $item->plate : $item->getPlate(),
                // 'test' => $item->reservationOperation,
            );
        }
        return $reservationdata;
    }

    public function operationlocationinformation($up_location, $drop_location)
    {
        $data = array(
            'up_location' => $this->location->getViewCenterId($up_location),
            'drop_location' => $this->location->getViewCenterId($drop_location),
        );
        return $data;
    }

    public function get_operation_redis_data()
    {
        $x = [];
        $data = json_decode($this->redis->get("operationData"), TRUE);
        if ($data != null) {
            $request = new Request($data);
            $x = $this->get_operation($request);
        }
        return $x;
    }

    public function tdcolor($id, $type)
    {

        if ($type == 'in') {
            $reservationoperation = ReservationOperation::where('type', 'drop')->where('id_reservation', $id)->get();
            if ($reservationoperation) {
                if (count($reservationoperation) == 1) {
                    return "background-color:#489a3f;color:#fff";
                } else {
                    return "";
                }
            }
        }

        if ($type == 'out') {
            $reservationoperation = ReservationOperation::whereIn('type', array('up', 'drop'))->where('id_reservation', $id)->get();
            if ($reservationoperation) {
                if (count($reservationoperation) == 2) {
                    return "background-color:#ffbe6e;color:#fff";
                } else {
                    return "";
                }
            }
        }
    }

    public function islettetcolor($veriable)
    {
        if ($veriable == 1) {
            return "background-color:#f8902c;";
        } else {
            return "background-color:#f00;";
        }
    }

    public function getReservationInfo(Reservation $reservation, string $type)
    {
        $x = $reservation->reservationInformation->up_drop_information;
        $info = json_decode($x, true);
        if ($type == 'in') {
            $data = array(
                'title' => Reservation::TYPE_TRANSLATIONS[$info['drop']['type']],
                'key' => $info['up']['key'],
                'value' => $info['up']['value'],
            );
        } else {
            $data = array(
                'title' => Reservation::TYPE_TRANSLATIONS[$info['drop']['type']],
                'key' => $info['drop']['key'],
                'value' => $info['drop']['value'],
            );
        }
        return $data;
    }

    public function welcome_print(Request $request)
    {
        $reservation = Reservation::find($request->id);
        $data = $this->staticData();
        return view('print.welcome', ['reservation' => $reservation, 'data' => $data]);
    }

    public function addmail(Request $request)
    {
        $reservation = Reservation::find($request->id);
        if ($reservation->comfirm_date != NULL) {
            $this->addError('Rezervasyon No: ' . $reservation->id . ' - Mesaj : Daha Önce ' . $request->status . ' Maili Gönderilmiştir..');
        } else if ($reservation->status == 'comfirm' && $request->status == 'comfirm' && $reservation->comfirm_date != NULL) {
            $this->addError('Rezervasyon No: ' . $reservation->id . ' - Mesaj : Daha Önce Onaylanmıştır.');
        } else if ($reservation->status == 'comfirm' && $request->status == 'cancel') {
            $this->addError('Rezervasyon No: ' . $reservation->id . ' - Mesaj : İptal Maili Gönderilemez.');
        } else if ($reservation->status == 'comfirm' && $request->status == 'comfirm_please') {
            $this->addError('Rezervasyon No: ' . $reservation->id . ' - Mesaj : Mail Komfirme Edilmiş.');
        }
        $this->dispatch(new \App\Jobs\SendMailJob($reservation, $request));
        $this->addError('Rezervasyon No: ' . $reservation->id . ' - Mesaj : ' . $request->status . ' Mail Gönderildi.');
        $this->logRepositoryInt->create($this->getErrors());
        return redirect()->back()->withErrors(['msg' => $this->getErrors()]);
    }

    public function addcomment(Request $request)
    {

        $reservation = Reservation::find($request->id);

        $reservationnote = new ReservationNote();
        $reservationnote->id_reservation = $request->id;
        $reservationnote->sender = "user";
        $reservationnote->messages = $request->messages;
        $reservationnote->type = $request->type;
        $reservationnote->id_user = Auth::guard('admin-web')->user()->id;
        $reservationnote->save();

        //$this->dispatch(new \App\Jobs\BasicMailJob($reservation, "Deneme", $request));
        return redirect()->back();
    }

    public function deletecomment(Request $request)
    {
        $x = ReservationNote::find($request->id);
        $x->delete();
    }

    public function getcomment($id)
    {
        $notes = [];
        $reservation = ReservationNote::where('id_reservation', $id)->get();
        foreach ($reservation as $item) {
            $notes[] = array(
                'type' => $item->type,
                'messages' => $item->messages,
                'sender' => $item->sender,
                'id_user' => $item->getuser->name ?? "Bulunamadı",
                'created_at' => $item->created_at,
            );
        }
        return $notes;
    }

    public function getPage(Request $request)
    {
        $reservation = Reservation::find($request->id);
        $data['reservation'] = $reservation;
        $data['car'] = Car::find($reservation->car);
        $data['file'] = 'email/' . $request->page;
        $data['user_language_id'] = $reservation->customer->language;
        $data['reservationEkstras'] = $reservation->reservationEkstras;
        $data['currency'] = Currency::find($reservation->id_currency)->right_icon;
        $data['request'] = $request;
        $data['ekstraMessage'] = "";
        $data['encode'] = "";
        $data['template'] = EmailTemplate::where('language_id', $reservation->customer->language)->where('email_template_id', $request->template_id)->first();
        return view('email/' . $request->page, $data);
    }

    public function changepaymentmethod(Request $request)
    {
        $reservation = Reservation::find($request->id);
        $reservation->payment_method = $request->payment_method;
        $reservation->save();
        return redirect()->back();
    }

    public function changerest(Request $request)
    {
        $reservation = Reservation::find($request->id);
        $reservation->rest -= $request->rest;
        $reservation->save();


        $log = [
            'Başlık' => "Rest değişikliği yapıldı",
            'Yeni Rest' => $request->rest,
        ];
        $this->saveLogReservation('restchange', $reservation->id, $log);

        return redirect()->back();
    }

    public function changeprice(Request $request)
    {
        $fixprice = $request->total_amount - ($request->drop_price + $request->up_price + $request->ekstra_price);

        $reservation = Reservation::find($request->id);
        $fitPrice = $reservation->total_amount;
        $reservation->total_amount = $request->total_amount;
        $reservation->day_price = round($fixprice / $request->days);
        $reservation->drop_price = $request->drop_price;
        $reservation->up_price = $request->up_price;
        $reservation->ekstra_price = $request->ekstra_price;
        $reservation->rent_price = $fixprice;
        $reservation->old_total_amount = $fitPrice;
        $reservation->save();
        $pdf = new PdfRevisionService($reservation);


        $log = [
            'Başlık' => "Fiyat değişikliği yapıldı",
            'Yeni Fiyat' => $request->total_amount,
            'Eski Fiyat' => $fitPrice,
        ];
        $this->saveLogReservation('pricechange', $reservation->id, $log);

        return redirect()->back();
    }

    public function changedetail(Request $request)
    {
        $reservationinformation = ReservationInformation::where('id_reservation', $request->id)->first();
        $reservationinformation->up_drop_information = json_encode($request->info);
        $reservationinformation->save();

        $reservation = Reservation::find($request->id);

        $log = [
            'Başlık' => "Detay değişikliği yapıldı",
            'Detay' => json_encode($request->info),
        ];
        $this->saveLogReservation('changedetail', $reservation->id, $log);
        return redirect()->back();
    }

    public function changelocation(Request $request)
    {

            $reservation = Reservation::find($request->id);

            $responsedata = array(
                'cikis_saati_submit'  => $request->up_time,
                'donus_saati_submit'  => $request->drop_time,
                'cikis_tarihi_submit' => $request->up_date,
                'donus_tarihi_submit' => $request->drop_date,
                'pick_up_location'    => $request->up_location,
                'end_point'           => $request->drop_location,
            );

            $currency = 'EUR_' . Currency::find($reservation->id_currency)->left_icon;

            $currencyResponse = new CurrencyService($currency);

            $currencyData = $currencyResponse->getCurrency();

            $singlecarpricelocation = new SingleCarPriceCalculate($responsedata, $currencyData, $reservation, $request);

            $x = $singlecarpricelocation->price_Calculate($reservation->car, $request->id);


            $reservation->checkin = Carbon::parse($request->up_date)->format('Y-m-d');
            $reservation->checkout = Carbon::parse($request->drop_date)->format('Y-m-d');;
            $reservation->checkin_time  = $request->up_time;
            $reservation->checkout_time = $request->drop_time;
            $reservation->up_location   = $request->up_location;
            $reservation->drop_location = $request->drop_location;
            $this->extracted($x, $reservation);
            $reservation->save();

            $reservationinformation = ReservationInformation::where('id_reservation', $request->id)->first();
            $reservationinformation->checkin = Carbon::parse($request->up_date)->format('Y-m-d');
            $reservationinformation->checkout = Carbon::parse($request->drop_date)->format('Y-m-d');
            $reservationinformation->checkin_time = $request->up_time;
            $reservationinformation->checkout_time = $request->drop_time;
            $reservationinformation->days = $request->days;
            $reservationinformation->up_location = $request->up_location;
            $reservationinformation->drop_location = $request->drop_location;
            $reservationinformation->save();

            $log = [
                'Başlık' => "Checkin ve Checkout bilgileri değiştirildi",
                'Yeni Detay' => json_encode($request->info),
                'Eski Detay' => "--",
            ];
            $this->saveLogReservation('changedetail', $reservation->id, $log);
            $message = "Değişiklik Yapıldı";


        return redirect()->back()->with('msg', $message);

    }

    public function changecurrency(Request $request)
    {

        $reservation = Reservation::find($request->id);

        $responsedata = array(
            'cikis_saati_submit' => $reservation->checkin_time,
            'donus_saati_submit' => $reservation->checkout_time,
            'cikis_tarihi_submit' => $reservation->checkin,
            'donus_tarihi_submit' => $reservation->checkout,
            'pick_up_location' => $reservation->reservationInformation->up_location,
            'end_point' => $reservation->reservationInformation->drop_location,
        );

        $currency = 'EUR_' . Currency::find($request->id_currency)->left_icon;

        $currencyResponse = new CurrencyService($currency);

        $currencyData = $currencyResponse->getCurrency();

        $singlecarpricelocation = new SingleCarPriceCalculate($responsedata, $currencyData, $reservation, $request);

        $x = $singlecarpricelocation->price_Calculate($reservation->car, $request->id);


        $reservation = Reservation::find($request->id);
        $reservation->id_currency = $request->id_currency;
        $this->extracted($x, $reservation);
        $reservation->ekstra_price = $x['ekstra_price'];
        $reservation->save();

        $log = [
            'Başlık' => "Kur Değiştirildi",
            'Yeni Kur' => $request->id_currency,
            'Eski Kur' => $reservation->id_currency,
        ];
        $this->saveLogReservation('changecurrency', $reservation->id, $log);

        return redirect()->back();

    }

    public function changeekstra(Request $request)
    {
        $reservation = Reservation::find($request->id);
        ReservationEkstra::where('id_reservation', $request->id)->delete();
        $customeekstraprice = 0;
        $ekstraCalculate = new EkstraCalculate();

        foreach ($request->ekstra as $ekstra) {
            $customeekstraprice += $ekstraCalculate->reservationEkstraCalculate($ekstra['id'], $request->days, $ekstra['value']);
            $ekstramodel = new ReservationEkstra();
            $ekstramodel->id_reservation = $request->id;
            $ekstramodel->id_ekstra = $ekstra['id'];
            $ekstramodel->day = $request->days;
            $ekstramodel->item = $ekstra['value'];
            $ekstramodel->price = $ekstraCalculate->reservationEkstraCalculate($ekstra['id'], $request->days, $ekstra['value']);
            $ekstramodel->save();
        }
        $reservation->ekstra_price = $customeekstraprice;
        $reservation->total_amount = $reservation->drop_price + $reservation->up_price + $customeekstraprice + $reservation->rent_price;
        $reservation->save();

        $log = [
            'Başlık' => "Ekstra Değiştirildi",
        ];

        $this->saveLogReservation('changeekstra', $reservation->id, $log, "Ekstra değiştirildi");
        return redirect()->back();
    }

    public function get_entry_exit($id)
    {
        $data = [];
        $reservationplate = ReservationOperation::where('id_reservation', $id)->get();
        foreach ($reservationplate as $item) {
            if ($item->type == 'up') {
                $data['up']['created'] = Carbon::parse($item->created_at)->format('d-m-Y');
                $data['up']['km'] = $item->km;
                $data['up']['fuel'] = $item->fuel;
                $data['up']['user'] = User::find($item->id_user)->name;
            } else {
                $data['drop']['created'] = Carbon::parse($item->created_at)->format('d-m-Y');
                $data['drop']['km'] = $item->km;
                $data['drop']['fuel'] = $item->fuel;
                $data['drop']['user'] = User::find($item->id_user)->name;
            }
        }
        return $data;
    }

    public function get_log_list($id): array
    {
        $content = [];
        $emails = ReservationEmail::where('id_reservation', $id)->get();
        foreach ($emails as $email) {
            $content[] = array(
                'class' => "ReservationEmail",
                'user' => User::find($email->id_user)->name,
                'description' => "Mail Gönderildi",
                'created_at' => $email->created_at,
                'detail' => self::EMAIL_STATUS[$email->status]
            );
        }
        $reservations = Reservation::where('id', $id)->get();
        if ($reservations) {
            foreach ($reservations as $reservation) {
                {
                    $content[] = array(
                        'class' => "Reservation",
                        'user' => User::find($reservation->user_id)->name,
                        'description' => "Rezervasyon oluşturma tarihi ",
                        'created_at' => $reservation->created_at,
                        'detail' => " "
                    );
                }
            }
        }


        $reservations = SystemLogs::where('system_logable_id', $id)->where('module_name', 'Reservation')->get();
        if ($reservations) {
            foreach ($reservations as $reservation) {
                {
                    $content[] = array(
                        'class' => "SystemLogs",
                        'user' => User::find($reservation->user_id)->name ?? "Bulunamadı",
                        'description' => "tarafından değişiklik yapıldı ",
                        'created_at' => $reservation->created_at,
                        'detail' => '<a href="systemlogread/' . $reservation->id . '" target="_blank">OKU</a>',
                    );
                }
            }
        }

        $reservationnotes = ReservationNote::where('id_reservation', $id)->get();
        if ($reservationnotes) {
            foreach ($reservationnotes as $reservationnote) {
                {
                    $content[] = array(
                        'class' => "ReservationNote",
                        'user' => User::find($reservationnote->id_user)->name ?? "Bulunamadı",
                        'description' => ($reservationnote->type == "closed") ? "İptal Edildi" : "Note",
                        'created_at' => $reservationnote->created_at,
                        'detail' => $reservationnote->messages,
                    );
                }
            }
        }

        $reservationlogs = ReservationLog::where('id_reservation', $id)->get();
        if ($reservationlogs) {
            foreach ($reservationlogs as $reservationlog) {
                {
                    $content[] = array(
                        'class' => "ReservationLog",
                        'user' => User::find($reservationlog->id_user)->name ?? "Bulunamadı",
                        'description' => Reservation::RESERVATION_LOG_TYPE_STRING[$reservationlog->type],
                        'created_at' => $reservationlog->created_at,
                        'detail' => $reservationlog->message,
                    );
                }
            }
        }
        return collect($content)->sortBy('created_at')->all();

    }

    public function get_note_list(Request $response)
    {
        $reservationnotes = ReservationNote::where('id_reservation', $response->id)->get();
        return $reservationnotes;
    }

    public function systemlogread($id)
    {
        $data['log'] = SystemLogs::find($id);
        return view('admin.reservation.systemlogread', $data);
    }

    public function getEncode($id)
    {
        $reservation = Reservation::find($id);
        $tokenarray = array(
            'id_reservation' => $reservation->id,
            'id_customer' => $reservation->id_customer,
            'created_at' => $reservation->created_at,
            "exp" => \Carbon\Carbon::parse($reservation->created_at)->timestamp
        );
        return JWT::encode($tokenarray, 'HS256');
    }

    public function get_customer_blacklist(Request $request)
    {
        $blacklist = BlackList::where("id_customer", $request->id)->first();
        if (is_null($blacklist)) {
            return "/public/assets/images/checked.png";
        } else {
            return "/public/assets/images/cancel.png";
        }
    }

    public function searchlist(Request $request)
    {
      if(!empty($request->all()))
      {
          $daterange = explode("-", $request->created_at);
          $validatedData = $request->validate([
              'checkin' => '',
              'plate' => '',
              'customer' => '',
              'model' => '',
              'fuel' => '',
              'brand' => '',
              'created_at' => '',
              'pnr' => '',
              'category' => '',
              'city_id' => '',
          ]);
          $x = [];
          $a = [];

          if (!is_null($request->plate)) {
              $plate = Plate::where('plate', $request->plate)->first();
              if ($plate) {
                  $reservation = Reservation::where("plate", $plate->id)->get();
                  $x[] = $reservation->id;
              }
          } else if (!is_null($request->pnr)) {
              $pnr = Reservation::where('pnr', 'LIKE', '%' . trim($request->pnr))->first();
              if ($pnr) {
                  $x[] = $pnr->id;
              }
          } else {

              $date1 = explode('/', $daterange[0]);
              $date2 = explode('/', $daterange[1]);


              $finalDate1 = trim($date1[2]) . '-' . trim($date1[1]) . '-' . trim($date1[0]);
              $finalDate2 = trim($date2[2]) . '-' . trim($date2[1]) . '-' . trim($date2[0]);
              $reservation = Reservation::whereBetween('created_at', [$finalDate1, $finalDate2])->get();
              $collection = collect($reservation);
              $x[] = $collection->implode('id', ', ');

              if ($request->start_date != $request->finish_date) {
                  $reservation = Reservation::whereBetween('checkin', [Carbon::parse($request->start_date)->format('Y-m-d'), Carbon::parse($request->finish_date)->format('Y-m-d')])->get();
                  $x[] = $reservation->implode('id', ', ');
              }

              if (!is_null($request->customer) && is_numeric($request->customer)) {
                  $customer = Reservation::select('id')->where("id_customer", $request->customer)->get();
                  $collection = collect($customer);
                  $x[] = $collection->implode('id', ', ');
              }

              if (!is_null($request->brand)) {

                  $brand = Car::select('id')->where("brand", $request->brand)->get();
                  $collection = collect($brand);
                  $x[] = $collection->implode('id', ', ');
              }
              if (!is_null($request->model)) {

                  $model = Car::select('id')->where("model", $request->model)->get();
                  $collection = collect($model);
                  $x[] = $collection->implode('id', ', ');
              }
              if (!is_null($request->category)) {

                  $category = Car::select('id')->where("category", $request->category)->get();
                  $collection = collect($category);
                  $x[] = $collection->implode('id', ', ');
              }
              if (!is_null($request->transmission)) {

                  $transmission = Car::select('id')->where("transmission", $request->transmission)->get();
                  $collection = collect($transmission);
                  $x[] = $collection->implode('id', ', ');
              }
              if (!is_null($request->status)) {

                  $reservation = Reservation::where("status", $request->status)->get();
                  $collection = collect($reservation);
                  $x[] = $collection->implode('id', ', ');
              }

              if ($request->city_id && !empty($request->city_id)) {
                  $id_parent = [];
                  $location = Location::where('id_parent',$request->city_id)->pluck('id');
                  $reservation = Reservation::whereIn("up_location",$location)->get();
                  $collection = collect($reservation);
                  $x[] = $collection->implode('id', ', ');
              }

          }

          $fill = array_filter($x);

          if (!empty($fill)) {
              foreach ($fill as $item) {
                  $xyz = explode(",", $item);
                  foreach ($xyz as $i) {
                      $a[] = $i;
                  }
              }

              if ($request->has('closed')) {
                  $data['reservation'] = Reservation::whereIn('id', $a)->whereNotNull('deleted_at')->orderBy('checkin', "asc")->orderBy('checkin_time', "asc")->get();
              }else{
                  $data['reservation'] = Reservation::whereIn('id', $a)->whereNull('deleted_at')->where("status" ,'!=', "closed")->orderBy('checkin', "asc")->orderBy('checkin_time', "asc")->get();
              }
          } else {
              $data['reservation'] = Reservation::whereDate('checkin', '>=', Carbon::today())->whereNull('deleted_at')->orderBy('checkin', "asc")->orderBy('checkin_time', "asc")->paginate($request->pagination);
          }

      }else{
          $data['reservation'] = $this->reservationRepository->getindex();
      }

        set_time_limit(0);
        ini_set('memory_limit', '-1');

        $data['reservationlog'] = "";
        $data['brands'] = Brand::all();
        $data['models'] = CarModel::all();
        $data['customers'] = Customer::all();
        $data['currencies'] = Currency::all();
        $x = new TotalCalculate($data['reservation']);
        $data['totalcalculate'] =   $x->handle();
         $data["request"] = $request;
        $data['breadcrumbs'] = "Arama Sonuçları";
        $data['categorys'] = Category::all();
        $data['locationView'] = Location::getViewMain();
        return view('admin.reservation.index', $data);
    }

    public function mediamodal(Request $request)
    {
        $type = $request->table_type;
        $id = $request->table_id;
        $data['operation'] = ReservationOperation::where('id_reservation', $id)->where('type', $type)->first();
        return view('admin.reservation.media', $data);
    }

    public function mediadownload(Request $request)
    {
        $file = public_path() . "/storage/reservation_history/" . $request->media;
        $headers = ['Content-Type: image/jpeg'];
        return \Response::download($file, 'plugin.jpg', $headers);
    }

    public function operationcontrol(Request $request)
    {
        $reservationoperation = ReservationOperation::where('id_reservation', $request->id)->where('type', $request->type)->count();
        return response()->json($reservationoperation);
    }

    public function updaterest(Request $request)
    {
        $reservation = Reservation::where('id', $request->id)->first();
        $reservation->rest = 0;
        $reservation->save();

        $reservationrest = new ReservationRest();
        $reservationrest->id_reservation = $request->id;
        $reservationrest->note = $request->note;
        $reservationrest->price = $request->price;
        $reservationrest->currency = $request->currency;
        $reservationrest->rest = 0;
        $reservationrest->save();


        $log = [
            'Başlık' => 'Tahsilat Tamamlandı',
            'Fiyat' => $request->price
        ];

        $this->saveLogReservation('restchange', $reservation->id, $log);

        return response()->json();
    }

    public function addcommentapi(Request $request)
    {
        if (!is_null($request->messages)) {
            $reservation = Reservation::find($request->id);
            $reservationnote = new ReservationNote();
            $reservationnote->id_reservation = $request->id;
            $reservationnote->sender = "user";
            $reservationnote->messages = $request->messages;
            $reservationnote->type = $request->type;
            $reservationnote->id_user = Auth::guard('admin-web')->user()->id;
            $reservationnote->save();
        }
    }

    /**
     * @param array $x
     * @param $reservation
     * @return void
     */
    public function extracted(array $x, $reservation): void
    {
        $reservation->rent_price = $x['rent_price'];
        $reservation->days = $x['total_day'];
        $reservation->drop_price = $x['drop_price'];
        $reservation->up_price = $x['up_price'];
        $reservation->total_amount = $x['ekstra_including_price'];
        $reservation->day_price = $x['day_price'];
    }
}
