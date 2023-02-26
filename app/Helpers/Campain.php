<?php namespace App\Helpers;


use App\Models\Brand;
use App\Models\Camping;
use App\Models\Car;
use App\Models\CarImage;
use App\Models\CarModel;
use App\Models\Ekstra;
use App\Models\Image;
use App\Models\Language;
use App\Models\Location;
use App\Models\LocationValue;
use App\Models\PeriodPrice;
use App\Models\Setting;
use App\Models\TransferZoneFee;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class Campain
{
    public static function calculate($data)
    {
        return $data->id_car;
        $up_time = $data->pick_up_time;
        $down_time = $data->pick_down_time;
        $up_location = $data->pick_up_location;
        $down_location = $data->pick_down_location;
        $up_date = $data->pick_up;
        $down_date = $data->pick_down;

        $dateDifference = static::dayDifference($up_date, $down_date);
        $dateDifferenceNew = static::timeCalculate($up_time, $down_time, $dateDifference);
        $period = static::getPeriod($dateDifferenceNew);
        $val = Car::find($data->id_car);

            $reponse = array(
                'car' => static::getBrandModel($val->brand, $val->model) . " " . $val->car_name,
                'price' => static::priceCalculate($data->id_campain, $period, $dateDifferenceNew),
                'onlinePrice' => static::priceCalculateOnline($val->id, $up_date, $down_date, $up_location, $period, $dateDifferenceNew, $up_time, $down_time),
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

        return $reponse;
    }

    public static function getBrandModel($brand = null, $model = null)
    {

        $brand = Brand::where("id", $brand)->get();
        if (count($brand) != 0) {
            $brand = $brand->first()->brandname ?? 0;
        } else {
            $brand = "Bulunamadı";
        }

        $model = CarModel::where("id", $model)->get();
        if (count($model) != 0) {
            $model = $model->first()->modelname ?? 0;
        } else {
            $model = "Bulunamadı";
        }
        return $brand . " " . $model;
    }

    public static function getDefaultImage($id)
    {
        $x = Image::where("default", "default")->where("id_module", $id)->where("module", "cars");
        if ($x->count() > 0) {
            return $x->first()->title;
        } else {
            return "no-image";
        }

    }

    public static function getImageList($id)
    {
        $x = Image::where("default", "normal")->where("id_module", $id)->where("module", "cars");
        if ($x->count() > 0) {
            return $x->get();
        } else {
            return array();
        }

    }

    public static function dayDifference($up_date, $down_date)
    {
        $up_date = new DateTime($up_date);
        $down_date = new DateTime($down_date);
        $interval = $up_date->diff($down_date);
        return $interval->format('%a');
    }

    public static function getPeriod($dateDifference)
    {
        if ($dateDifference < 3) {
            return "price1";
        } else if ($dateDifference > 4 && $dateDifference <= 6) {
            return "price2";
        } else if ($dateDifference > 7 && $dateDifference <= 13) {
            return "price3";
        } else if ($dateDifference > 14 && $dateDifference <= 30) {
            return "price4";
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

    public static function priceCalculate($id_campain,  $period,$days)
    {
       $campain = Camping::find($id_campain);
       return $campain->$period * $days;
    }

    public static function getMounth($date)
    {
        return date("m", strtotime($date));
    }

    public static function dayPrice($id_campain, $period)
    {
         return Camping::find($id_campain)->$period;
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
            $x += Ekstra::where("input_name", $key)->first()->price * $value;
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
                'TotalItemPrice' => $x->price * $value,
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

    public static function priceCalculateOnline($id_campain,  $period, $dateDifference)
    {

        $periodData = PeriodPrice::find($id_campain);
        $onlinePrice = $periodData->$period - (($periodData->$period * 2) / 100);
        return $onlinePrice;
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

}

