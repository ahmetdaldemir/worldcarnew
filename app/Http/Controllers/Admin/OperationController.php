<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Currency;
use App\Models\Location;
use App\Models\Plate;
use App\Models\Reservation;
use App\Models\ReservationOperation;
use App\Models\ReservationPlate;
use App\Repository\Data;
use App\Service\PdfRevisionService;
use App\Service\Reservation\TotalCalculate;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Redis;
use Illuminate\Http\Request;

class OperationController extends Controller
{

    protected $reservationdata;
    protected $operation;

    public function __construct()
    {
        $this->reservationdata = [];
        $this->redis = new Redis();
        $this->redis->connect('localhost', 6379);
    }


    public function index()
    {
         $reservationarray = [];
         $query = Reservation::whereNull('deleted_at')->where("status" ,'!=', "closed")
             ->whereBetween('checkin', [Carbon::now()->subDays(1)->format('Y-m-d'), Carbon::now()->addDays(1)->format('Y-m-d')])
             ->orderBy('checkin', 'asc')->orderBy('checkin_time', 'asc')->get();

         foreach ($query as $item) {
            $updropinfo = json_decode($item->reservationInformation->up_drop_information,TRUE);

            if($updropinfo)
            {
                $up_location_detail = Reservation::TYPE_TRANSLATIONS[$updropinfo['up']['type'] ??  Reservation::TYPE_TRANSLATIONS['up']] ." ". $updropinfo['up']['key'] ." ". $updropinfo['up']['value'];
                $drop_location_detail = Reservation::TYPE_TRANSLATIONS[$updropinfo['drop']['type'] ??  Reservation::TYPE_TRANSLATIONS['drop']] ." ". $updropinfo['drop']['key'] ." ". $updropinfo['drop']['value'];
            } else{
                $up_location_detail = "";
                $drop_location_detail = "";
            }
            if ($item->plate == null) {
                $carinfo = $item->reservationCar->brandfunction->brandname ." ".  $item->reservationCar->modelfunction->modelname;
                $carinfodetail =  $item->reservationCar->fuel . " " . $item->reservationCar->transmission;
            } else {
                $carinfo = $item->getPlate->car->brandfunction->brandname . " " . $item->getPlate->car->modelfunction->modelname;
                $carinfodetail = $item->getPlate->car->fuel . " " . $item->getPlate->car->transmission;
            }

            $reservationarray[] = array(
                'id' => $item->id,
                'pnr' => $item->pnr,
                'customer_fullname' => $item->fullname(),
                'customer_phone' => $item->customer->phone,
                'customer_id' => $item->customer->id,
                'car_info' => $carinfo,
                'car_info_detail' => $carinfodetail,
                'ekstras' => $item->reservationEkstras,
                'checkin' => Carbon::parse($item->checkin)->format('d-m-Y'),
                'checkout' => Carbon::parse($item->checkout)->format('d-m-Y'),
                'checkintime' => Carbon::parse($item->checkin_time)->format('H:i'),
                'checkouttime' => Carbon::parse($item->checkout_time)->format('H:i'),
                'day_price' => $item->day_price,
                'days' => $item->days,
                'drop_date' => $item->drop_date,
                'up_date' => $item->up_date,
                'comfirm_date' => $item->comfirm_date,
                'ekstra_price' => $item->ekstra_price,
                'total_amount' => $item->total_amount,
                'location' => $this->getLocationDetail($item->id),
                'rest' => $item->rest,
                'up_location' => $item->up_location,
                'id_currency' => $item->id_currency,
                'currency_icon' => Currency::find($item->id_currency)->right_icon,
                'payment_method' => $item->getPaymentMethod(),
                'up_location_name' => $item->uplocationName(),
                'up_location_detail' => $up_location_detail,
                'drop_location_detail' => $drop_location_detail,
                'drop_location_name' => $item->droplocationName(),
                'note' => $item->reservationNotes,
                'reservationStatus' => Reservation::RESERVATION_STATUS_STRING[$item->status??"not_found"],
                'reservationStatusClass' => $item->getReservationStatusClass(),
                'reservationInfo' => $item->reservationInformation,
                'reservationInfoUp' => json_decode($item->reservationInformation->up_drop_information, TRUE),
                'tdcolor' => $this->tdcolor($item->id,'in'),
                'is_letter' => $this->islettetcolor($item->is_letter),
                'plate' => $item->plate ? $item->getPlate->plate : "Atanmadı" ,
                'warning_color' => Reservation::RESERVATION_STATUS_COLOR[$item->status],
                'delivery_personal' =>  $item->reservationOperationDrop(),
                'drop_personal' => $item->reservationOperationUp(),
                'reservationrest' => $item->reservationRest(),
                'reservationcount' => $item->reservationCount(),

            );
        }
        $car = Car::orderBy('id')->get();
        $plates = Plate::where('status', Plate::PLATE_STATUS_FREE)->get();
        $location = Location::getViewMain();
        $data = new Data();
        $users = User::all();
        $allplates = Plate::all();
        $currencies = Currency::all();
        $request = "";

        $x = new TotalCalculate((object)$reservationarray);
        $totalcalculate = $x->handle();

        return view("admin.operation.index",compact('car','plates','location','data','reservationarray','request','users','allplates','currencies','totalcalculate'));
    }


    public function getLocationDetail($id)
    {

        $data = [];
        $item = Reservation::find($id);
        $reservationinformation = $item->reservationInformation->up_drop_information;
        $details = json_decode($reservationinformation, true);

        if($details)
        {
            $data = array(
                'up_location'   =>   Location::getViewCenterId($item->reservationInformation->up_location ?? null)[0]->title   ?? null,
                'drop_location' =>   Location::getViewCenterId($item->reservationInformation->drop_location ?? null)[0]->title ?? null,
                'up_type'       =>   Reservation::TYPE_TRANSLATIONS[$details['up']['type'] ?? Reservation::TYPE_TRANSLATIONS['up']],
                'drop_type'     =>   Reservation::TYPE_TRANSLATIONS[$details['drop']['type'] ?? Reservation::TYPE_TRANSLATIONS['drop']]
            );
        }else{
            $data = array(
                'up_location'   =>   Location::getViewCenterId($item->reservationInformation->up_location ?? null)[0]->title   ?? null,
                'drop_location' =>   Location::getViewCenterId($item->reservationInformation->drop_location ?? null)[0]->title ?? null,
                'up_type'       =>   "Bulunamadı",
                'drop_type'     =>   "Bulunamadı"
            );
        }

return $data;

      //  'uplocationName' => Location::getViewLocationName($item->up_location),
        // 'droplocationName' => Location::getViewLocationName($item->drop_location),
    }

    public function search(Request $request)
    {

         $validated = $request->validate([
            'type' => 'required',
            'date_time_last' => 'nullable',
            'plate' => 'nullable',
            'reservation_status' => 'nullable',
            'payment_method' => 'nullable',
            'city_id' => 'nullable',
            'car' => 'nullable',
            'plates' => 'nullable',
            'closed' => 'nullable',
        ]);
        $reservationarray = [];

        if ($request->has('closed')) {
            $query = Reservation::where('test', 1);
        }else{
            $query = Reservation::whereNull('deleted_at')->where("status" ,'!=', "closed")->where('test', 1);
        }


        if ($request->type == "in") {
            if ($request->has('date_time_first')) {
                $query->whereBetween('checkin', [Carbon::parse($request->date_time_first)->format('Y-m-d'), Carbon::parse($request->date_time_last)->format('Y-m-d')])->orderBy('checkin', 'asc')->orderBy('checkin_time', 'asc');
            }
        }
        if ($request->type == "out") {
            if ($request->has('date_time_last')) {
                $query->whereNotNull('drop_date')->whereBetween('checkout', [Carbon::parse($request->date_time_first)->format('Y-m-d'), Carbon::parse($request->date_time_last)->format('Y-m-d')])->orderBy('checkout', 'asc')->orderBy('checkout_time', 'asc');
            }
        }

        if ($request->payment_method && !empty($request->payment_method)) {
            $query->where('payment_method', '=', $request->payment_method);
        }

        if ($request->reservation_status && !is_null($request->reservation_status)) {
            $query->where('status', '=', $request->reservation_status);
        }



        if ($request->plate != 2) {
            if ($request->plate != 0) {
                $query->whereNotNull('plate');
            } else {
                $query->whereNull('plate');
            }
        }


        if ($request->plates && !empty($request->plates)) {
            $query->where('plate', '=', $request->plates);
        }


        if ($request->car && !empty($request->car)) {
            $query->where('car', '=', $request->car);
        }


        if ($request->city_id && !empty($request->city_id)) {
            $id_parent = [];
            $gets = $query->get();
            $location = Location::where('id_parent',$request->city_id)->pluck('id');
            if ($request->type == "in") {
                $query->whereIn('up_location',  $location);
            }

            if ($request->type == "out") {
                $query->whereIn('drop_location',  $location);
            }
        }


        $x = $query->get();
        foreach ($x as $item) {
            Log::info('id/'.$item->id);
            if ($item->plate == null) {
                $carinfo = $item->reservationCar->brandfunction->brandname ." ".  $item->reservationCar->modelfunction->modelname;
                $carinfodetail =  $item->reservationCar->fuel . " " . $item->reservationCar->transmission;
            } else {
                $carinfo = $item->getPlate->car->brandfunction->brandname . " " . $item->getPlate->car->modelfunction->modelname;
                $carinfodetail = $item->getPlate->car->fuel . " " . $item->getPlate->car->transmission;
            }

            $reservationarray[] = array(
                'id' => $item->id,
                'pnr' => $item->pnr,
                'customer_fullname'   => $item->fullname(),
                'customer_phone'      => $item->customer->phone,
                'customer_id'      => $item->customer->id,
                'car_info'            => $carinfo,
                'car_info_detail'     => $carinfodetail,
                'checkin'             => Carbon::parse($item->checkin)->format('d-m-Y'),
                'checkout'            => Carbon::parse($item->checkout)->format('d-m-Y'),
                'checkintime'         => Carbon::parse($item->checkin_time)->format('H:i'),
                'checkouttime'        => Carbon::parse($item->checkout_time)->format('H:i'),
                'day_price'           => $item->day_price,
                'ekstras'             => $item->reservationEkstras,
                'days'                => $item->days,
                'drop_date'           => $item->drop_date,
                'up_date'             => $item->up_date,
                'ekstra_price'        => $item->ekstra_price,
                'comfirm_date'        => $item->comfirm_date,
                'total_amount'        => $item->total_amount,
                'rest'                => $item->rest,
                'location'            => $this->getLocationDetail($item->id),
                'up_location'         => $item->up_location,
                'id_currency'         => $item->id_currency,
                'currency_icon'       => Currency::find($item->id_currency)->right_icon,
                'payment_method'      => $item->getPaymentMethod(),
                'up_location_name'    => $item->uplocationName(),
                'drop_location_name'  => $item->droplocationName(),
                'note' => $item->reservationNotes,
                'reservationStatus' => Reservation::RESERVATION_STATUS_STRING[$item->status??"not_found"],
                'reservationStatusClass' => $item->getReservationStatusClass(),
                'reservationInfo' => $item->reservationInformation,
                'reservationInfoUp' => json_decode($item->reservationInformation->up_drop_information, TRUE),
                'tdcolor' => $this->tdcolor($item->id,$request->type),
                'is_letter' => $this->islettetcolor($item->is_letter),
                'plate' => $item->plate ? $item->getPlate->plate : "Atanmadı" ,
                'warning_color' => Reservation::RESERVATION_STATUS_COLOR[$item->status],
                'delivery_personal' =>  $item->reservationOperationDrop() ?? null,
                'drop_personal' => $item->reservationOperationUp() ?? null,
                'reservationrest' => $item->reservationRest(),
                'reservationcount' => $item->reservationCount(),

            );
        }
        $car = Car::orderBy('id')->get();
        $plates = Plate::where('status', Plate::PLATE_STATUS_FREE)->get();
        $location = Location::getViewMain();
        $data = new Data();
        $users = User::all();
        $allplates = Plate::all();
        $currencies = Currency::all();
        $x = new TotalCalculate((object)$reservationarray);
        $totalcalculate = $x->handle();

        return view("admin.operation.index",compact('car','plates','location','data','reservationarray','request','users','allplates','currencies','totalcalculate'));
    }
    public function tdcolor($id,$type = null)
    {
        if($type == 'in')
        {
            $reservationoperation = ReservationOperation::where('type','drop')->where('id_reservation', $id)->first();
            if ($reservationoperation) {
                return "background-color:#ff9900;color:#fff";
            }else{
                return "background-color:#ffffcc;color:#000";
            }
        }else if($type == 'out')
        {
            $reservationoperation = ReservationOperation::where('type', 'up')->where('id_reservation', $id)->first();
            if ($reservationoperation) {
                return "background-color:#ffcc00;color:#fff";
            }else{
                return "background-color:#ffffcc;color:#000";
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
    public function operationlocationinformation($up_location, $drop_location)
    {
        $data = array(
            'up_location' => $this->location->getViewCenterId($up_location),
            'drop_location' => $this->location->getViewCenterId($drop_location),
        );
        return $data;
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


        return redirect()->route('admin.admin.operation.index')->with('msg', $message);
    }

}
