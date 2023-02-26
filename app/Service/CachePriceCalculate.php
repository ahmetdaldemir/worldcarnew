<?php


namespace App\Service;


use App\Models\Brand;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\Ekstra;
use App\Models\EkstraLanguage;
use App\Models\Image;
use App\Models\Language;
use App\Models\Location;
use App\Models\LocationValue;
use App\Models\PeriodPrice;
use App\Models\ReservationEkstra;
use App\Models\Setting;
use App\Models\StopSell;
use App\Models\TransferZoneFee;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Log;
use JetBrains\PhpStorm\ArrayShape;


class CachePriceCalculate
{
    protected $up_time;
    protected $down_time;
    protected $up_date;
    protected $down_date;
    protected $up_location;
    protected $drop_location;
    protected $mainLocation;
    protected $reservation_time_diff;
    protected $dropLocation;
    private array $mounth_diffarence;
    private int $mountdiff;
    private int $yeardiff;
    private float $diffarence_period_price;
    protected $drop_price;
    protected $up_price;
    protected $up_drop_price;


    public function __construct($responseData, $currencyData, $id_car)
    {
        session(['currency' => $currencyData]);

        $this->up_time = $responseData["cikis_saati_submit"];
        $this->down_time = $responseData["donus_saati_submit"];
        $this->drop_price = 0;
        $this->up_date = $responseData["cikis_tarihi_submit"];
        $this->down_date = $responseData["donus_tarihi_submit"];
        $this->up_location = $responseData["pick_up_location"];
        $this->currency_Data = $currencyData;
        if (isset($responseData["end_point"])) {
            $this->drop_location = $responseData["end_point"];
        } else {
            $this->drop_location = $this->up_location;
        }
        $this->reservation_time_diff = Setting::where('key', "reservation_time")->first()->value;
        $this->mainLocation = Location::find($this->up_location);
        $this->dropLocation = Location::find($this->drop_location);
        $this->date_diffarence = $this->date_Difference();
        $this->time_diffarence = $this->time_Difference();

        $this->mountdiff = Carbon::parse($this->up_date)->diffInMonths(Carbon::parse($this->down_date));
        $this->yeardiff = Carbon::parse($this->up_date)->diffInYears(Carbon::parse($this->down_date));
        $this->mounth_diffarence = $this->mount_difference();

        $diffarence_period_price = 0;


        $this->full_date = $this->date_diffarence + $this->time_diffarence;
        $this->period = $this->rent_Period();
        $this->cars = Car::find($id_car)->toArray();
        $this->date_mounth_range = $this->date_Month_Range();
        $this->calculate = CAL_GREGORIAN;
        if ($this->mainLocation->id_parent != 0) {
            $this->queryLocation = $this->mainLocation->id_parent;
        } else {
            $this->queryLocation = $this->mainLocation->id;
        }
        $this->settings = new Setting();
        $this->price = 0;
        $this->day_price = 0;
        $this->discount = 0;
        $this->drop_Location_Price = 0;

        $this->up_price = $this->mainLocation->price;
        $this->up_drop_price = $this->dropLocation->drop_price;
        $this->ekstras = $responseData['ekstra'];
    }

    public function date_Difference(): int
    {
        $start = Carbon::parse($this->up_date);
        $end = Carbon::parse($this->down_date);
        return $end->diffInDays($start);
    }

    public function time_Difference(): int
    {
        if ($this->up_time < $this->down_time) {
            $startTime = Carbon::parse($this->up_time);
            $finishTime = Carbon::parse($this->down_time);

            $diff = $finishTime->diffInMinutes($startTime);

            if ($diff > $this->reservation_time_diff) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    public function mount_difference(): array
    {
        $month = [];
        $date1 = $this->up_date;
        $date2 = $this->down_date;
        $time = strtotime($date1);
        $start = date("m", strtotime("+1 month", $time));

        $d1 = explode('-', $date1);
        $d2 = explode('-', $date2);

        for ($m = $start; $m < $d2[1]; $m++) {
            $month[] = date('m', mktime(0, 0, 0, $m, 1, date('Y')));
        }
        return $month;
    }


    public function rent_Period()
    {

        if ($this->full_date <= 3) {
            return "period1";
        } else if ($this->full_date > 3 && $this->full_date <= 6) {
            return "period2";
        } else if ($this->full_date > 6 && $this->full_date <= 10) {
            return "period3";
        } else if ($this->full_date > 10 && $this->full_date <= 13) {
            return "period4";
        } else if ($this->full_date > 13 && $this->full_date <= 20) {
            return "period5";
        } else if ($this->full_date > 20 && $this->full_date <= 29) {
            return "period6";
        } else if ($this->full_date >= 30) {
            return "period7";
        }
    }

    public function date_Month_Range()
    {
        $start_mounth = date("m", strtotime($this->up_date));
        $finish_mounth = date("m", strtotime($this->down_date));
        if ($start_mounth != $finish_mounth) {
            return TRUE;
        }
    }

    public function rent_Mounth($date): string
    {
        return date("m", strtotime($date));
    }

    public function price_Calculate($id_car, $id_resservation,$outside_discount)
    {
        $rent_price = 0;
        $diffarence_period_price = 0;

        $mainlocationparent = Location::find($this->mainLocation->id_parent);
        $droplocationparent = Location::find($this->dropLocation->id_parent);


        $transferPrice = TransferZoneFee::where('id_location', $mainlocationparent->id)->where('id_location_transfer_zone', $droplocationparent->id)->first();
        if ($transferPrice) {
            $this->drop_Location_Price = $transferPrice->price;
        }

        if ($this->up_location != $this->drop_location) {
            if ($this->up_drop_price > 0) {
                $this->drop_price = $this->up_drop_price;
            } else {
                $this->drop_price = $this->drop_Location_Price;
            }
        }


        if ($this->date_mounth_range == FALSE) {
            if ($mainlocationparent->min_day <= $this->full_date) {
                $period_data = PeriodPrice::where("id_car", $id_car)->where("mounth", $this->rent_Mounth($this->up_date))->where("id_location", $this->queryLocation)->where("status", TRUE)->first();
                if ($period_data) {
                    $this->price = $period_data->{$this->period} * $this->full_date;
                    $this->day_price = $period_data->{$this->period};
                    $this->discount = $period_data->discount;
                }
            }
        }
        if ($this->date_mounth_range == TRUE) {

            $yil_up = date('Y', strtotime($this->up_date));
            $mounth = date('m', strtotime($this->up_date));
            $start_date_days_count = cal_days_in_month($this->calculate, $mounth, $yil_up);
            $start_date_day = $yil_up . "-" . $mounth . "-" . $start_date_days_count;
            $up_date_count = $this->customDifference($this->up_date, $start_date_day);

            $yil_down = date('Y', strtotime($this->down_date));
            $mounth_down = date('m', strtotime($this->down_date));
            $finish_date_days_count = cal_days_in_month($this->calculate, $mounth_down, $yil_down);
            $finish_date_day = $yil_down . "-" . $mounth_down . "-" . 1;

            $down_date_count = $this->customDifference($this->down_date, $finish_date_day);

            $last_down_date_count = $this->time_diffarence + $down_date_count;

            $first_period = PeriodPrice::where("id_car", $id_car)->where("min_day", '<=', $this->full_date)->where("mounth", $this->rent_Mounth($this->up_date))->where("id_location", $this->mainLocation->id_parent)->where("status", TRUE)->first();
            $second_period = PeriodPrice::where("id_car", $id_car)->where("mounth", $this->rent_Mounth($this->down_date))->where("id_location", $this->mainLocation->id_parent)->where("status", TRUE)->first();

            if ($mainlocationparent->min_day <= $this->full_date) {

                if (isset($first_period) && isset($second_period)) {
                    $first_period_price = $first_period->{$this->period} * $up_date_count;
                    $second_period_price = $second_period->{$this->period} * ($last_down_date_count + 1);


                    $this->day_price = $first_period->{$this->period};

                    if ($this->mountdiff >= 1) {
                        foreach ($this->mounth_diffarence as $difference) {

                            $diffarence_period_days_count = cal_days_in_month($this->calculate, $difference, date("Y"));

                            $diffarence_period = PeriodPrice::where("id_car", $id_car)->where("mounth", $difference)->where("id_location", $this->mainLocation->id_parent)->where("status", TRUE)->first();

                            if ($diffarence_period) {
                                $diffarence_period_price += $diffarence_period->{$this->period} * $diffarence_period_days_count;
                            }
                        }
                    }
                    if ($first_period->{$this->period} != 0 && $second_period->{$this->period} != 0) {
                        $this->price = $first_period_price + $second_period_price + $diffarence_period_price;
                    } else {
                        $this->price = 0;
                    }

                }
            }
            $this->discount = $first_period->discount ?? 0;
        }
        $total_sub_price = $this->price + $this->up_price + $this->drop_price - $outside_discount;
        $rent_price = $this->price;
        $ekstraPrice = $this->calculateEkstra();
        $ekstra_including_price = $total_sub_price + $ekstraPrice;
        $total_price = $ekstra_including_price - (($ekstra_including_price * $this->discount) / 100);

        if ($this->mainLocation->min_day > $this->full_date) {
            $priceArray = array(
                'drop_price' => 0,
                'min_day' => $this->mainLocation->min_day,
                'up_price' => 0,
                'up_drop_price' => 0,
                'main_price' => 0,
                'total_day' => $this->full_date,
                'day_price' => 0,
                'rent_price' => 0,
                'discount' => 0,
                'discount_price' => 0,
                'currency_data' => (float)$this->currency_Data,
                'mandatoryInContract' => $this->mandatoryInContract(),
                'ekstra_including_price' => 0,
                'this_price' => $this->price,
            );
        } else {
            $priceArray = array(
                'drop_price' => $this->drop_price * (float)$this->currency_Data,
                'min_day' => $this->mainLocation->min_day,
                'up_price' => $this->up_price * (float)$this->currency_Data,
                'up_drop_price' => $this->up_drop_price * (float)$this->currency_Data,
                'main_price' => ($this->price + $this->up_price + $this->drop_price) * (float)$this->currency_Data,
                'total_day' => $this->full_date,
                'day_price' => ($rent_price / $this->full_date) * (float)$this->currency_Data,
                'rent_price' => $rent_price * (float)$this->currency_Data,
                'discount' => $this->discount,
                'discount_price' => $total_price * (float)$this->currency_Data,
                'currency_data' => (float)$this->currency_Data,
                'mandatoryInContract' => $this->mandatoryInContract(),
                'ekstra_including_price' => $ekstra_including_price * (float)$this->currency_Data,
                'this_price' => $this->drop_price,
                'ekstra_price' => $ekstraPrice * (float)$this->currency_Data,
            );
        }
        return $priceArray;
    }

    public function mandatoryInContract()
    {
        $mandatoryprice = 0;
        $mandatoryEkstra = Ekstra::where("mandatoryInContract", "yes")->get();
        foreach ($mandatoryEkstra as $item) {
            $mandatoryprice += $item->price;
        }
        return $mandatoryprice;
    }

    public static function customDifference($up_date, $down_date): int
    {
        $start = Carbon::parse($up_date);
        $end = Carbon::parse($down_date);
        $length = $end->diffInDays($start);

        return $length;
    }

    public function calculateEkstra()
    {
        $x = 0;
        $days = $this->date_Difference();
        foreach ($this->ekstras as $key => $value) {
            $ekstra = Ekstra::find($key);
            if ($ekstra->sellType == 'daily') {
                $x += $ekstra->price * $days * $value[0];
            } else {
                $x += $ekstra->price * $value[0];
            }
        }
        return $x;
    }

    public static function doco_convert($data)
    {
        if (strpos($data, ".")) {
            $chng = str_replace(".", ",", $data);
            $data = $chng;
        }
        return $data;
    }

    public static function codo_convert($data)
    {
        if (strpos($data, ".")) {
            $chng = str_replace(",", ".", $data);
            $data = $chng;
        }
        return $data;
    }

}
