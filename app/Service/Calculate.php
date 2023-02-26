<?php

namespace App\Service;

use App\Models\Brand;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\Category;
use App\Models\Ekstra;
use App\Models\Location;
use App\Models\PeriodPrice;
use App\Models\Plate;
use App\Models\Reservation;
use App\Models\Setting;
use App\Models\TransferZoneFee;
use App\Repositories\Plate\PlateRepository;
use App\Repositories\Plate\PlateRepositoryInterface;
use Carbon\Carbon;
use DateTime;
use http\Client\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

class Calculate
{
    protected $checkin;
    protected $checkout;
    protected $up_location;
    protected $drop_location;
    protected $up_date;
    protected $drop_date;
    protected $up_time;
    protected $drop_time;
    protected $currency;
    protected $country;
    protected $cars;
    protected $categorys;
    protected $days;
    protected $only_days;
    protected $period;
    protected $mounth;
    protected $first_period;
    protected $second_period;
    protected $drop_period;
    protected $drop_price;
    protected $currency_data;
    protected $pricelast;
    protected $reservation_time_diff;
    protected $warningColor;
    protected $warningColorMessage;
    protected $diff_count;
    private $plateRepository;

    public function __construct($request)
    {
        $plateRepository = new PlateRepository();

        $this->categorys = new Category();
        $this->plates = new Plate();
        $this->plateRepository = $plateRepository;
        $this->checkin = $request->checkin;
        $this->checkout = $request->checkout;
        $this->up_location = Location::find($request->up_location);
        $this->drop_location = Location::find($request->drop_location);
        $this->up_date = $request->up_date;
        $this->drop_date = $request->drop_date;
        $this->up_time = $request->up_time;
        $this->drop_time = $request->drop_time;
        $this->currency = $request->currency;
        $this->country = $request->country;
        $this->cars = Car::where("is_active", 1)->get();
        $this->platescollection =$this->plateList();// $this->plateList();
        $this->calculate = CAL_GREGORIAN;
        $this->pricelast = 0;
        $this->warningColor = null;
        $this->warningColorMessage = null;
        $this->pricelast1 = 0;
        $this->diff_count = 0;
        $this->periodList = [];
        $this->mountdiff = Carbon::parse($this->up_date)->diffInMonths(Carbon::parse($this->drop_date)) == 0 ? '2' : Carbon::parse($this->up_date)->diffInMonths(Carbon::parse($this->drop_date));

        $this->yeardiff = Carbon::parse($this->up_date)->diffInYears(Carbon::parse($this->drop_date));
        $this->mounth_diffarence = $this->mount_difference();
        $this->reservation_time_diff = Setting::where('key', "reservation_time")->first()->value;
    }

    public function index()
    {

        $response = array();

        if (Carbon::parse($this->drop_date)->format("Y-m-d") < Carbon::parse($this->up_date)->format("Y-m-d")) {
            return Response::json(array(
                'code' => 401,
                'message' => "Çıkış tarihi dönüş tarihinden büyük olamaz",
            ), 200);
        }


        $currency = new CurrencyService($this->currency);
        $this->currency_data = $currency->getCurrency();
        $this->currency_icon = $currency->getCurrencyIcon();
        if (empty($this->drop_location)) {
            $this->drop_location = $this->up_location;
        }
        $this->day_count();
        $this->which_period();

        if ($this->days == 0) {
            return response()->noContent();
        }
        if(count($this->mounth_diffarence) > 2)
        {
            array_pop($this->mounth_diffarence);
            array_shift($this->mounth_diffarence);
        }


        //$plates = $this->plates->whereIn("status", [Plate::PLATE_STATUS_FREE,Plate::PLATE_STATUS_BUSY])->orderBy('id_car', 'asc')->get();
        //$plates = $this->plates->where("status",'!=',Plate::PLATE_STATUS_ARCHIVE)->where("status",'!=',Plate::PLATE_STATUS_BUSY)->orderBy('id_car', 'asc')->get();
    foreach ($this->platescollection as $plate) {
             $response[] = array(
                'id' => $plate->id,
                'id_car' => $plate->id_car,
                'drop_date' => $this->drop_date,
                'up_date' => $this->up_date,
                'currency' => $this->currency,
                'period' => $this->period,
                'currency_price' => $this->currency_data,
                'currency_icon' => $this->currency_icon,
                'days' => $this->days,
                'cars' => $this->carinfo($plate->id_car),
                'plate' => $plate->plate,
                'id_plate' => $plate->id,
                'price' => $this->price($plate->id_car),
                'only_days' => $this->only_days,
                // 'warning_color' => $this->warning_color($plate->id),
                'return' => $this->returninfo($plate->id),
                'xx1' => $this->mounth_diffarence,
                'periodlist' => $this->periodList,
             );
      }
        return $response;
    }

    public function plateStatus($id)
    {
        $result = Reservation::where('checkin', '<=', Carbon::parse($this->drop_date)->format("Y-m-d"))->where('checkout', '>=', Carbon::parse($this->up_date)->format("Y-m-d"))->get();
        if (!$result) {
            return Plate::PLATE_STATUS_STRING[50];
        } else {
            return Plate::PLATE_STATUS_STRING[40];
        }
    }

    public function returninfo($id)
    {
        $data = [];
        $reservation = Reservation::where('plate', $id)->whereNotNull('drop_date')->orderByDesc('drop_date')->first();
        if ($reservation) {
            $location_name = new Location();
            $title = $location_name->getViewLocationName($reservation->drop_location);
            $data['finish']['reservation_name'] = $title->sort ?? "Bulunamadı";
            $data['finish']['reservation_date'] = $reservation->checkout;
            $data['finish']['reservation_time'] = date('H:i', strtotime($reservation->checkout_time));
        }
        $reservation1 = Reservation::where('plate', $id)->whereNull('drop_date')->orderByDesc('id')->first();
        if ($reservation1) {
            $location_name = new Location();
            $title = $location_name->getViewLocationName($reservation1->drop_location);
            $data['wait']['reservation_name'] = $title->sort ?? "Bulunamadı";
            $data['wait']['reservation_date'] = $reservation1->checkout;
            $data['wait']['reservation_time'] = date('H:i', strtotime($reservation1->checkout_time));
        }
        return $data;
    }

    public function carinfo($id)
    {
        $car = Car::find($id);
        $brand = Brand::find($car->brand);
        $model = CarModel::find($car->model);
        return @$brand->brandname . " / " . @$model->modelname . " - " . Car::TRANSMISSION_SORT[$car->transmission] . " - " . Car::FUEL_SORT[$car->fuel];
    }

    public function mount_difference(): array
    {
        /*   $month = [];
           $date1 = $this->up_date;
           $date2 = $this->drop_date;
           $time = strtotime($date1);
           $start = date("m", strtotime("+1 month", $time));
           $d1 = explode('-', $date1);
           $d2 = explode('-', $date2);

           for ($m = $start; $m < $d2[1]; $m++) {
               $month[] = date('m', mktime(0, 0, 0, $m, 1, date('Y')));
           }
           return $month;
   */
        $month = [];
        $date1 = $this->up_date;
        $date2 = $this->drop_date;
        $time = strtotime($date1);
        $start = date("m", strtotime("+0 month", $time));
        // $start = date("m",strtotime($date1));
        $d1 = explode('-', $date1);
        $d2 = explode('-', $date2);

        Log::info($d2[1]);
        if($start > $d2[1])
        {
            for ($m = $start; $m < $start + $d2[1] + 1; $m++) {
                $month[] = date('m', mktime(0, 0, 0, $m, 1, date('Y')));
            }
        }else{
            for ($m = $start; $m < $d2[1]; $m++) {
                $month[] = date('m', mktime(0, 0, 0, $m, 1, date('Y')));
            }
            array_shift($month);
        }
        return $month;
    }

    public function price($id_car)
    {
        $this->first_period = PeriodPrice::where("id_car", $id_car)->where("mounth", $this->which_month($this->up_date))->where("id_location", $this->up_location->id_parent)->where("status", 1)->first();
        $this->second_period = PeriodPrice::where("id_car", $id_car)->where("mounth", $this->which_month($this->drop_date))->where("id_location", $this->up_location->id_parent)->where("status", 1)->first();

        $data = array(
            'day_price' => number_format((($this->rent_price($id_car) / $this->days) * (float)$this->currency_data), 2),
            'rent_price' => round($this->rent_price($id_car) * (float)$this->currency_data),
            'up_price' => round($this->up_price() * (float)$this->currency_data),
            'drop_price' => round($this->drop_price() * (float)$this->currency_data),
            'mount_diff' => $this->days,
            'test' => $this->first_period,
        );

        return $data;
    }

    public function rent_price($id_car)
    {

        $diffarence_period_price = 0;
        $whichperiod = $this->period;
        if ($this->first_period && $this->second_period) {
            if ($this->first_period->id == $this->second_period->id) {
                $price = ($this->first_period->$whichperiod) * $this->days;
                if ($this->first_period->discount != 0 || $this->first_period->discount == NULL) {
                    $this->pricelast = $price - (($price * $this->first_period->discount) / 100);
                }
            } else {

                $start_first_day = Carbon::parse($this->up_date)->endOfMonth();
                $start_second_day = Carbon::parse($this->drop_date)->startOfMonth();
                $mounthfinishdate = date('Y-m-d', strtotime($start_first_day));
                $firstdays = $this->date_diff($this->up_date, $mounthfinishdate);

                $secondmounthfinishdate = date('Y-m-d', strtotime($start_second_day));
                $seconddays = $this->date_diff($secondmounthfinishdate, $this->drop_date) + 1 + $this->diff_count;

                $price1 = $this->first_period->$whichperiod * $firstdays;
                $price2 = $this->second_period->$whichperiod * $seconddays;

                if ($this->first_period->discount != 0 && !is_null($this->first_period->discount)) {
                    $price1 = $price1 - (($price1 * $this->first_period->discount) / 100);
                }
                $price = $price1 + $price2;



                    $this->periodList = $this->mounth_diffarence;


                    foreach ($this->mounth_diffarence as $difference) {
                        $diffarence_period_days_count = cal_days_in_month($this->calculate, $difference, date("Y"));
                        $diffarence_period = PeriodPrice::where("id_car", $id_car)->where("mounth", $difference)->where("id_location", $this->up_location->id_parent)->where("status", TRUE)->first();

                        if ($diffarence_period) {
                            $diffarence_period_price += $diffarence_period->{$this->period} * $diffarence_period_days_count;
                        } else {
                            $diffarence_period_price += 0;
                        }
                    }



                $this->pricelast1 = $diffarence_period_price;
                $this->pricelast = $price + $diffarence_period_price;
            }
        } else {
            $this->pricelast = 0;
        }
        return $this->pricelast;
    }

    public function day_price()
    {
        $whichperiod = $this->period;

        if ($this->first_period && $this->second_period) {
            $price = ($this->first_period->$whichperiod + $this->second_period->$whichperiod) / 2;
        } else {
            $price = 0;
        }
        return $price;
    }

    public function drop_price()
    {
        $price = TransferZoneFee::where('id_location', $this->up_location->id_parent)->where('id_location_transfer_zone', $this->drop_location->id_parent)->first();

        if ($this->up_location != $this->drop_location) {
            if ($this->drop_location->drop_price > 0) {
                $drop_price = $this->drop_location->drop_price;
            } else {
                $drop_price = $price->price;
            }
        }
        return $drop_price ?? 0;
    }

    public function up_price()
    {
        return $this->up_location->price;
    }

    public function day_count()
    {
        $start = Carbon::parse($this->up_date);
        $end = Carbon::parse($this->drop_date);
        $this->only_days = $end->diffInDays($start);
        $this->days = $this->time_diff();
    }

    public function mounth_diff()
    {
        $start_mounth = date("m", strtotime($this->up_date));
        $finish_mounth = date("m", strtotime($this->drop_date));
        if ($start_mounth == $finish_mounth) {
            return 1;
        } else {
            return 2;
        }
    }

    public function time_diff()
    {

        if ($this->up_time < $this->drop_time) {
            $startTime = Carbon::parse($this->up_time);
            $finishTime = Carbon::parse($this->drop_time);
            $diff = $finishTime->diffInMinutes($startTime);
            if ($diff > $this->reservation_time_diff) {
                $this->diff_count = 1;
                return $this->only_days + 1;
            } else {
                $this->diff_count = 0;
                return $this->only_days;
            }
        } else {
            $this->diff_count = 0;
            return $this->only_days;
        }
    }

    public function which_month($date)
    {
        return date("m", strtotime($date));
    }

    public function which_period()
    {
        if ($this->days <= 3) {
            $this->period = "period1";
        } else if ($this->days > 3 && $this->days <= 6) {
            $this->period = "period2";
        } else if ($this->days > 6 && $this->days <= 10) {
            $this->period = "period3";
        } else if ($this->days > 10 && $this->days <= 13) {
            $this->period = "period4";
        } else if ($this->days > 13 && $this->days <= 20) {
            $this->period = "period5";
        } else if ($this->days > 20 && $this->days <= 29) {
            $this->period = "period6";
        } else if ($this->days >= 30) {
            $this->period = "period7";
        }


    }

    public function date_diff($startdate, $finishdate)
    {

        //echo Carbon::parse('2000-01-01 12:00')->floatDiffInDays('2000-02-11 06:00');     // 40.75

        //echo  Carbon::parse('2021-08-26')->endOfMonth();

        $start = Carbon::parse($startdate);
        $end = Carbon::parse($finishdate);
        $this->custom_days = $end->diffInDays($start);
        return $this->custom_days;

    }

    public function plateList()
    {
        $reservations = [];
        $result1 = Plate::all();

        foreach ($result1 as $item) {
            $reservations[] = $this->checkPlate($item->id);
        }

        $reservations = array_filter($reservations);

        if (!is_null($reservations)) {
            $plates = $this->plateRepository->getIn($reservations);
        } else {
            $plates = $this->plateRepository->all();
        }
        return $plates;
    }

    public function mandatoryInContract()
    {
        $mandatoryprice = 0;
        $mandatoryEkstra = Ekstra::where("mandatoryInContract", "yes")->get();
        foreach ($mandatoryEkstra as $item) {
            if ($item->sellType == "daily") {
                $mandatoryprice += $item->price * $this->days;
            } else {
                $mandatoryprice += $item->price;
            }
        }
        return $mandatoryprice;
    }

    public function plateListTest()
    {

        $reservations = [];
        $result = Reservation::whereNotNull('plate')
            ->where('checkout', Carbon::parse($this->up_date)->format('Y-m-d'))->whereNull('deleted_at')
            ->get();
        foreach ($result as $item) {
            if ($item->checkout_time > Carbon::parse($this->up_time)->format('H:i:s')) {
                $reservations[] = $item->plate;
            }
        }

        $result1 = \DB::select("select plate from reservations where plate IS NOT NULL and  checkout > '" . Carbon::parse($this->up_date)->format('Y-m-d') . "' and deleted_at IS NULL ");
        foreach ($result1 as $item) {
            $reservations[] = $item->plate;
        }
        if (!is_null($reservations)) {
            $plates = Plate::where("status", '!=', Plate::PLATE_STATUS_ARCHIVE)->whereNotIn('id', $reservations)->orderBy('id_car', 'asc')->get();
        } else {
            $plates = Plate::where("status", '!=', Plate::PLATE_STATUS_ARCHIVE)->orderBy('id_car', 'asc')->get();
        }
        return $plates;
    }

    public function warning_color($id)
    {
        $result = Reservation::whereNotNull('plate')->where('checkout', '>=', Carbon::parse($this->up_date)->format("Y-m-d"))->pluck('plate');
        if (!is_null($result)) {
            $plates = Plate::where("status", '!=', Plate::PLATE_STATUS_ARCHIVE)->whereNotIn('id', $result)->pluck('id');
            $reservations = Reservation::whereIn('plate', $plates)->whereNull('drop_date')->get();
            foreach ($reservations as $x) {
                $this->warningColor = "#f00";
                $this->warningColorMessage = "Aracın Dönüşü Yapıldı";
            }
        }
    }

    public function checkPlate($id)
    {
        //echo Carbon::parse($this->drop_date)->format('Y-m-d');
        $thisTime = Carbon::parse($this->up_time)->timestamp;
        $x = \DB::select("select * from reservations where
                                  plate = $id
                             and  checkout >= '" . Carbon::parse($this->up_date)->format('Y-m-d') . "'
                             and  checkin <= '" . Carbon::parse($this->drop_date)->format('Y-m-d') . "'
                             and status IN ('new','comfirm','waiting') and deleted_at IS NULL LIMIT 1 ");


        if (!empty($x)) {
            foreach ($x as $item)
            {

                $resTime = Carbon::parse($item->checkout_time)->timestamp;
                if (($item->checkout == Carbon::parse($this->up_date)->format("Y-m-d") )  && ($thisTime >= $resTime)) {
                    return $id;
                }
            }

        }else{
            return $id;
        }
    }

    public function getAvaibleAll()
    {

        $reservations = [];

        $result1 = \DB::select("SELECT  p.id as plateid,r.id,r.checkin,r.checkout,r.checkin_time,r.checkout_time
FROM reservations r INNER JOIN plates p ON p.id = r.plate
WHERE r.checkout  >= '" . Carbon::parse($this->checkin)->format('Y-m-d') . "' and r.checkin  <= '" . Carbon::parse($this->checkout)->format('Y-m-d') . "' and r.plate is not null and r.status IN ('new','waiting','comfirm')");


        foreach ($result1 as $item) {
            if($item->checkout != $this->checkin or ($item->checkout == $this->checkin and $item->checkout_time >= $this->checkin_time)){
                $reservations[] = $item->plateid;
            }
        }
        if (!is_null($reservations)) {
            $plates = $this->getNotIn($reservations);
        } else {
            $plates = $this->all();
        }
        return $plates;
    }

    public function all()
    {
        return Plate::where("status", '!=', Plate::PLATE_STATUS_ARCHIVE)->where("status", '!=', Plate::PLATE_STATUS_CRASHED)->get()->sortBy(function($query){
            return $query->car->brand;
        })->all();

    }
    public function getNotIn(array $reservations)
    {
        return Plate::where("status", '!=', Plate::PLATE_STATUS_ARCHIVE)->where("status", '!=', Plate::PLATE_STATUS_CRASHED)->whereNotIn('id', $reservations)->get()->groupBy(function($query){
            return $query->car->model;
        })->all();
    }

}
