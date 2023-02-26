<?php


namespace App\Service\Payment;


use App\Models\Brand;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\Ekstra;
use App\Models\Image;
use App\Models\Language;
use App\Models\Location;
use App\Models\LocationValue;
use App\Models\PeriodPrice;
use App\Models\TransferZoneFee;
use App\Service\CurrencyService;
use Illuminate\Database\Eloquent\Model;

class Search
{
    protected static array $mainLocation;

    public static function calculate($data, $currency)
    {

        $currency = new CurrencyService($currency);
        $currencyData = $currency->getCurrency();

        $up_time = $data["cikis_saati_submit"];
        $down_time = $data["donus_saati_submit"];

        $up_date = $data["cikis_tarihi_submit"];
        $down_date = $data["donus_tarihi_submit"];

        $up_location = $data["pick_up_location"];
        if (isset($data["end_point"])) {
            $drop_location = $data["end_point"];
        } else {
            $drop_location = $up_location;
        }

        $mainLocation = Location::find($up_location);
        $dropLocation = Location::find($drop_location);

        $dateDifference = static::dayDifference($up_date, $down_date);
        $dateDifferenceNew = static::timeCalculate($up_time, $down_time, $dateDifference);
        $period = static::getPeriod($dateDifferenceNew);
        $cars = Car::where("is_active", 1)->get();
        $settings = new Setting();
        foreach ($cars as $val) {
            $reponse[] = array(
                'car' => static::getBrandModel($val->brand, $val->model) . " " . $val->car_name,
                'price' => round(static::priceCalculate($val->id, $up_date, $down_date, $up_location, $drop_location, $period, $dateDifferenceNew, $up_time, $down_time, $currencyData)),
                'days' => $dateDifferenceNew,
                'transmission' => $val->transmission,
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
                'image' => $val->default_images,
                'imageLists' => static::getImageList($val->id),
                'car_km' => $settings->where('key', "car_km")->first()->value,
                'car_km_day' => $settings->where('key', "car_km_day")->first()->value,
                'license_age' => $settings->where('key', "license_age")->first()->value,
                'driver_age' => $settings->where('key', "driver_age")->first()->value,
            );
        }
        dd($reponse);
        return $reponse;
    }

    public static function getBrandModel($brand = null, $model = null)
    {

        $brand = Brand::find($brand);
        $brand = $brand->brandname ?? "Bulunamadı";

        $model = CarModel::find($model);
        $model = $model->modelname ?? "Bulunamadı";
        return $brand . " " . $model;
    }

    public static function getDefaultImage($id)
    {
        return Image::where("default", "default")->where("id_module", $id)->where("module", "cars")->first();
    }

    public static function getImageList($id)
    {
        return Image::where("default", "normal")->where("id_module", $id)->where("module", "cars")->get();
    }

    public static function dayDifference($up_date, $down_date)
    {
        $start = Carbon::parse($up_date);
        $end = Carbon::parse($down_date);
        $length = $end->diffInDays($start);
        return $length;
    }

    public static function getPeriod($dateDifference)
    {
        if ($dateDifference < 3) {
            return "period1";
        } else if ($dateDifference > 3 && $dateDifference <= 7) {
            return "period2";
        } else if ($dateDifference > 7 && $dateDifference <= 10) {
            return "period3";
        } else if ($dateDifference > 10 && $dateDifference <= 13) {
            return "period4";
        } else if ($dateDifference > 14 && $dateDifference <= 20) {
            return "period5";
        } else if ($dateDifference > 21 && $dateDifference <= 29) {
            return "period6";
        } else if ($dateDifference >= 30) {
            return "period7";
        }
    }

    public static function dateDiff($up_date, $down_date)
    {
        $start_mounth = date("m", strtotime($up_date));
        $finish_mounth = date("m", strtotime($down_date));
        if ($start_mounth == $finish_mounth) {
            return 1;
        } else {
            return 2;
        }
    }

    public static function priceCalculate($id_car, $up_date, $down_date, $up_location, $drop_location, $period, $dateDifference, $up_time, $down_time, $currencyData)
    {

        $dateDiff = static::dateDiff($up_date, $down_date);
        $mainLocation = Location::find($up_location);
        $mainLocationDrop = $mainLocation->price;
        $dropLocation = Location::find($drop_location);
        $dropLocationPrice = $dropLocation->price;
        if ($mainLocation) {
            if ($mainLocation->id_parent != 0) {
                $queryLocation = $mainLocation->id_parent;
            } else {
                $queryLocation = $mainLocation->id;
            }
            $periodData = PeriodPrice::where("id_car", $id_car)->where("mounth", static::getMounth($up_date))->where("id_location", $queryLocation)->where("status", "on")->first();
            if ($periodData) {
                if ($dateDiff == 1) {
                    $price = $periodData->$period * $dateDifference;
                    if ($periodData->discount == NULL || $periodData->discount == 0) {
                        $priceArray = array(
                            'drop_price' => ($mainLocationDrop * (float)$currencyData),
                            'delivery_price' => ($dropLocationPrice * (float)$currencyData),
                            'main_price' => (($price + $mainLocationDrop + $dropLocationPrice) * (float)$currencyData),
                            'total_day' => $dateDifference,
                            'day_price' => $periodData->$period,
                        );
                        return $priceArray;
                    } else {
                        $calculate = $price - (($price * $periodData->discount) / 100);
                        $priceArray = array(
                            'drop_price' => ($mainLocationDrop * (float)$currencyData),
                            'delivery_price' => ($dropLocationPrice * (float)$currencyData),
                            'main_price' => (($calculate + $mainLocationDrop + $dropLocationPrice) * (float)$currencyData),
                            'total_day' => $dateDifference,
                            'day_price' => $periodData->$period,
                        );
                        return $priceArray;
                    }
                } else {
                    $takvim = CAL_GREGORIAN;
                    $yil = date('Y', strtotime($up_date));
                    $mounth = date('m', strtotime($up_date));

                    $start_date_days_count = cal_days_in_month($takvim, $mounth, $yil);
                    $start_date_day = $yil . "-" . $mounth . "-" . $start_date_days_count;

                    //Başlangıç tarihinin ay sonuna kadar olan süresi
                    $up_date_count = static::dayDifference($up_date, $start_date_day);


                    $yil_down = date('Y', strtotime($down_date));
                    $mounth_down = date('m', strtotime($down_date));

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
                    $priceArray = array(
                        'drop_price' => ($mainLocationDrop * (float)$currencyData),
                        'delivery_price' => ($dropLocationPrice * (float)$currencyData),
                        'main_price' => ($price1 + $price2 + $mainLocationDrop + $dropLocationPrice) * (float)$currencyData,
                        'total_day' => $dateDifference,
                        'day_price' => $periodData->$period,
                    );
                    return $priceArray;
                }
            } else {
                $priceArray = array(
                    'drop_price' => 0,
                    'delivery_price' => 0,
                    'main_price' => 0,
                    'total_day' => $dateDifference,
                    'day_price' => 0,
                );
                return $priceArray;
            }
        } else {
            return redirect('/');
        }
    }

    public static function getMounth($date)
    {
        return date("m", strtotime($date));
    }

    public static function dayPrice($id_car, $up_date, $up_location, $period, $currencyData)
    {
        //$currencyData= self::doco_convert($currencyData);

        $mainLocation = Location::find($up_location);
        if ($mainLocation->id_parent != 0) {
            $queryLocation = $mainLocation->id_parent;
        } else {
            $queryLocation = $mainLocation->id;
        }
        $periodData = PeriodPrice::where("id_car", $id_car)->where("mounth", static::getMounth($up_date))->where("id_location", $queryLocation)->first();
        if ($periodData) {
            if ($periodData->$period > 0) {
                $priceData = array(
                    'dayPrice' => $periodData->$period * (float)$currencyData,
                    'dayPriceOnline' => ($periodData->$period - (($periodData->$period * 2) / 100)) * (float)$currencyData
                );
                return $priceData;
            } else {
                $priceData = array(
                    'dayPrice' => 0,
                    'dayPriceOnline' => 0
                );
                return $priceData;
            }

        } else {
            $priceData = array(
                'dayPrice' => 0,
                'dayPriceOnline' => 0
            );
            return $priceData;
        }
    }

    public static function timeCalculate($up_time, $down_time, $days)
    {
        $baslangic = new DateTime($up_time);
        $fark = $baslangic->diff(new DateTime($down_time));
        $diff = $fark->h;
        if ($diff > 2) {
            return $days + 1;
        } else {
            return $days;
        }
    }

    public static function calculateEkstra($ekstra)
    {
        $x = 0;
        foreach ($ekstra as $key => $value) {
            $x += Ekstra::where("input_name", $key)->first()->price * $value[0];
        }
        return $x;
    }

    public static function ekstraProcess($ekstra)
    {
        $data = array();

        foreach ($ekstra as $key => $value) {

            $x = Ekstra::where("input_name", $key)->first();
            $data[] = array(
                'EkstaName' => $x->title,
                'EkstaPrice' => $x->price,
                'EkstaItem' => $value,
                'TotalItemPrice' => $x->price * $value[0],
            );
        }
        return $data;
    }

    public static function generalTotal($ekstra)
    {
        $data = array();
        foreach ($ekstra as $key => $value) {
            $x = Ekstra::where("input_name", $key)->first();
            $data[] = array(
                'EkstaName' => $x->title,
                'EkstaPrice' => $x->price,
                'EkstaItem' => $value,
                'TotalItemPrice' => $x->price * $value,
            );
        }
        return $data;
    }

    public static function priceCalculateOnline($id_car, $up_date, $down_date, $up_location, $down_location, $period, $dateDifference, $up_time, $down_time, $currencyData)
    {
        $dateDiff = static::dateDiff($up_date, $down_date);
        $mainLocation = Location::where("id", $up_location)->first();
        if ($mainLocation->id_parent != 0) {
            $queryLocation = $mainLocation->id_parent;
        } else {
            $queryLocation = $mainLocation->id;
        }
        $periodData = PeriodPrice::where("id_car", $id_car)->where("mounth", static::getMounth($up_date))->where("id_location", $queryLocation)->first();
        if (!empty($periodData)) {
            if ($dateDiff == 1) {
                $price = $periodData->$period * $dateDifference;
                if ($periodData->discount == NULL) {
                    $onlinePrice = $price - (($price * 2) / 100);
                    return $onlinePrice * $currencyData;
                } else if ($periodData->discount == 0) {
                    $onlinePrice = $price - (($price * 2) / 100);
                    return $onlinePrice * $currencyData;
                } else {
                    $calculate = $price - (($price * $periodData->discount) / 100);
                    $onlinePrice = $calculate - (($calculate * 2) / 100);
                    return $onlinePrice * $currencyData;
                }
            } else {
                $takvim = CAL_GREGORIAN;
                $yil = date('Y', strtotime($up_date));
                $mounth = date('m', strtotime($up_date));

                $start_date_days_count = cal_days_in_month($takvim, $mounth, $yil);
                $start_date_day = $yil . "-" . $mounth . "-" . $start_date_days_count;

                //Başlanguç tarihinin ay sonuna kadar olan süresi
                $up_date_count = static::dayDifference($up_date, $start_date_day);


                $yil_down = date('Y', strtotime($down_date));
                $mounth_down = date('m', strtotime($down_date));

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
                $totalPrice = $price1 + $price2;
                $onlinePrice = $totalPrice - (($totalPrice * 2) / 100);
                return $onlinePrice * $currencyData;
            }
        } else {
            return 0;
        }

    }

    public static function getOperationType($location)
    {
        return Location::where("id", $location)->first()->type;
    }

    public static function getMounthName($date, $index)
    {
        setlocale(LC_TIME, 'turkish');
        $x = iconv('latin5', 'utf-8', strftime('%d %B %Y %A', strtotime($date)));
        $x = explode(" ", $x);
        return $x[$index];
    }

    public static function getPickupMain($id)
    {
        return Location::find($id)->id_parent;
    }

    public static function getLocationName(int $id)
    {
        $langId = Language::where("url", app()->getLocale())->first()->id;
        return LocationValue::where("id_location", $id)->where("id_lang", $langId)->first()->title;
    }

    public static function getDropLocation(int $ids)
    {
        $langId = Language::where("url", app()->getLocale())->first()->id;
        if ($ids == 0) {
            $location = Location::join('location_values', 'locations.id', '=', 'location_values.id_location')->select('locations.*', 'location_values.title')->where('location_values.id_lang', 1)->get();
        } else {
            $id_location = Location::find($ids)->id_parent;
            $transferLocation = TransferZoneFee::where("id_location", $id_location)->where("status", 1)->get();
            foreach ($transferLocation as $item) {
                $locatiValue = LocationValue::where("id_location", $item->id_location_transfer_zone)->where("id_lang", $langId)->first();
                $location[] = array(
                    'id' => $item->id_location_transfer_zone,
                    'title' => $locatiValue->title,
                    'id_parent' => Location::find($item->id_location_transfer_zone)->id_parent,
                    'type' => $locatiValue->type,
                );
            }
        }
        return $location;
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
