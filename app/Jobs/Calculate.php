<?php

namespace App\Jobs;


use App\Models\Car;
use App\Models\Location;
use App\Models\PeriodPrice;
use App\Models\Setting;
use phpseclib3\File\ASN1\Maps\InvalidityDate;

class Calculate
{

    protected object $upLocationResponse;
    protected object $dropLocationResponse;
    protected string $up_time;
    protected string $down_time;
    protected string $up_date;
    protected string $down_date;
    protected int $up_location;
    protected int $drop_location;
    protected int $length;
    protected string $period;
    protected string $upPrice;
    protected string $dropPrice;
    protected array $cars;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(object $data)
    {
        $this->up_location = $data->pick_up_location;
        if (isset($data->end_point)) {
            $this->drop_location = $data->end_point;
        } else {
            $this->drop_location = $this->up_location;
        }

        $this->upLocationResponse = Location::find($this->up_location);
        $this->dropLocationResponse = Location::find($this->drop_location);
        $this->up_time = $data->cikis_saati_submit;
        $this->down_time = $data->donus_saati_submit;
        $this->up_date = $data->cikis_tarihi_submit;
        $this->down_date = $data->donus_tarihi_submit;
        $this->cars = array();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->dayDifference();
        $this->timeCalculate();
        $this->period = $this->getPeriod();
        $cars = Car::where("is_active", 1)->get();

        foreach ($cars as $val) {
            $reponse[] = array(
                'car' => static::getBrandModel($val->brand, $val->model) . " " . $val->car_name,
                'price' => static::priceCalculate($val->id),
                'onlinePrice' => static::priceCalculateOnline($val->id, $up_date, $down_date, $up_location, $drop_location, $period, $dateDifferenceNew, $up_time, $down_time),
                'days' => $dateDifferenceNew,
                'day_price' => static::dayPrice($val->id, $up_date, $up_location, $period),
                'gear' => $val->transmission,
                'id_car' => $val->id,
                'period' => $period,
                'fuel' => $val->fuel,
                'type' => $val->type,
                'category' => $val->category,
                'doors' => $val->doors,
                'passenger' => $val->passenger,
                'big_luggage' => $val->big_luggage,
                'small_luggage' => $val->small_luggage,
                'sun_roof' => $val->sun_roof,
                'air_conditioner' => $val->air_conditioner,
                'image' => static::getDefaultImage($val->id),
                'imageLists' => static::getImageList($val->id),
                'car_km' => Setting::where('key', "car_km")->orderBy("id", "desc")->limit(1)->get(),
                'car_km_day' => Setting::where('key', "car_km_day")->orderBy("id", "desc")->limit(1)->get(),
                'license_age' => Setting::where('key', "license_age")->orderBy("id", "desc")->limit(1)->get(),
                'driver_age' => Setting::where('key', "driver_age")->orderBy("id", "desc")->limit(1)->get(),
            );
        }
        $this->cars = $reponse;
    }


    public function dayDifference()
    {
        try {
            $start = Carbon::parse($this->up_date);
            $end = Carbon::parse($this->down_date);
            $length = $end->diffInDays($start);
            return $this->length;
        } catch (\Exception $e) {
            return $e;
        }

    }


    public function timeCalculate()
    {
        $baslangic = new DateTime($this->up_time);
        $fark = $baslangic->diff(new DateTime($this->down_time));
        $diff = $fark->h;
        if ($diff > 2) {
            $this->length = $this->length + 1;
            return $this->length;
        } else {
            return $this->length;
        }
    }

    public  function getPeriod()
    {
        if ($this->length < 3) {
            return "period1";
        } else if ($this->length > 3 && $this->length <= 7) {
            return "period2";
        } else if ($this->length > 7 && $this->length <= 10) {
            return "period3";
        } else if ($this->length > 10 && $this->length <= 13) {
            return "period4";
        } else if ($this->length > 14 && $this->length <= 20) {
            return "period5";
        } else if ($this->length > 21 && $this->length <= 29) {
            return "period6";
        } else if ($this->length >= 30) {
            return "period7";
        }
    }

    public function priceCalculate($id_car)
    {
        $dateDiff = $this->compareMonths();
        $this->upPrice = $this->upLocationResponse->first()->price;
        $this->dropPrice = $this->dropLocationResponse->first()->price;

        if ($this->up_location->count() != 0) {
            if ($this->upLocationResponse->first()->id_parent != 0) {
                $queryLocation = $this->upLocationResponse->first()->id_parent;
            } else {
                $queryLocation = $this->upLocationResponse->first()->id;
            }
            $periodData = PeriodPrice::where("id_car", $id_car)->where("mounth", static::getMounth($this->up_date))->where("id_location", $queryLocation)->where("status", "on")->first();
            if (!empty($periodData)) {
                if ($dateDiff == 1) {
                    $price = $periodData->{$this->period} * $this->length;
                    if ($periodData->discount == NULL) {
                        $total = $price + $this->upPrice + $this->dropPrice;
                        return $total;
                    } else if ($periodData->discount == 0) {
                        $total = $price + $this->upPrice + $this->dropPrice;
                        return $total;
                    } else {
                        $calculate = $price - (($price * $periodData->discount) / 100);
                        $total = $calculate + $this->upPrice + $this->dropPrice;
                        return $total;
                    }
                }else {
                    $takvim = CAL_GREGORIAN;
                    $yil = date('Y', strtotime($this->up_date));
                    $mounth = date('m', strtotime($this->up_date));

                    $start_date_days_count = cal_days_in_month($takvim, $mounth, $yil);
                    $start_date_day = $yil . "-" . $mounth . "-" . $start_date_days_count;

                    //Başlangıç tarihinin ay sonuna kadar olan süresi
                    $up_date_count = static::dayDifference($this->up_date, $start_date_day);


                    $yil_down = date('Y', strtotime($this->down_date));
                    $mounth_down = date('m', strtotime($this->down_date));

                    $finish_date_days_count = cal_days_in_month($takvim, $mounth_down, $yil_down);
                    $finish_date_day = $yil . "-" . $mounth_down . "-" . $finish_date_days_count;

                    //Başlanguç tarihinin ay sonuna kadar olan süresi
                    $down_date_count = static::dayDifference($down_date, $finish_date_day);
                    $dateDifferenceNew = static::timeCalculate($up_time, $down_time, $down_date_count);

                    $periodData = PeriodPrice::where("id_car", $id_car)->where("mounth", static::getMounth($up_date))->where("id_location", $up_location)->first();
                    if ($periodData) {
                        $price_first = $periodData->$period * $up_date_count;
                        if ($periodData->discount == NULL) {
                            $price1 = $price_first;
                        } else if ($periodData->discount == 0) {
                            $price1 = $price_first;
                        } else {
                            $calculate = $price_first - (($price_first * $periodData->discount) / 100);
                            $price1 = $calculate;
                        }
                    } else {
                        $price1 = 0;
                    }
                    $periodData_finish = PeriodPrice::where("id_car", $id_car)->where("mounth", static::getMounth($down_date))->where("id_location", $up_location)->first();
                    if ($periodData_finish) {
                        $price_second = $periodData_finish->$period * $dateDifferenceNew;

                        if ($periodData_finish->discount == NULL) {
                            $price2 = $price_second;
                        } else if ($periodData_finish->discount == 0) {
                            $price2 = $price_second;
                        } else {
                            $calculate = $price_second - (($price_second * $periodData_finish->discount) / 100);
                            $price2 = $calculate;
                        }
                    } else {
                        $price2 = 0;
                    }
                    return $price1 + $price2 + $mainLocationDrop + $dropLocationPrice;
                }
            } else {
                return "Biz Sizi Arayalım";
            }
        } else {
            return  redirect('/');
        }
    }


    public function compareMonths()
    {
        $start_mounth = date("m", strtotime($this->up_date));
        $finish_mounth = date("m", strtotime($this->down_date));
        if ($start_mounth == $finish_mounth) {
            return 1;
        } else {
            return 2;
        }
    }


}
