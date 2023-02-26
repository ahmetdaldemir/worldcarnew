<?php

namespace App\Models;

use App\Repository\Data;

class Camping extends Base
{
    protected $period;

    public function __construct()
    {
        $this->period = "";
    }


    public  function handle()
    {
       $langId = Language::where("url",app()->getLocale())->first()->id;
       $camping = Camping::where("status",1)->where("finish_date",">",date("Y-m-d"))->take(6);
       if($camping->count() > 0)
       {
           foreach ($camping->get() as $value)
           {
                $this->which_period($value->period_validity);
               if($this->period == "period1")
               {
                   $price = $value->price1;
               }else if($this->period == "period2")
               {
                   $price = $value->price3;
               }else if($this->period == "period3")
               {
                   $price = $value->price3;
               }else if($this->period == "period4")
               {
                   $price = $value->price4;
               }else if($this->period == "period5")
               {
                   $price = $value->price4;
               }else if($this->period == "period6")
               {
                   $price = $value->price4;
               }else if($this->period == "period7")
               {
                   $price = $value->price4;
               }

               $langData = CampingLanguage::where("id_camping",$value->id)->where("id_lang",$langId)->first();
               $data[] = array(
                   'image' => 'yenibosna-oto-kiralama.jpg',
                   'title' => $langData->title,
                   'id' => $value->id,
                   'price' => $price,
                   'start_date' => $value->start_date,
                   'finish_date' => $value->finish_date,
                   'car_image' => Image::where("module","cars")->where("id_module",$value->id_car)->where("status","1")->where("default","default")->first()->title,
                   'slug' => $langData->slug,
                   'car' => self::getCarInfo($value->id_car),
                   'day' => $value->period_validity,
                   'period' => $value->period,
                   'attributes' => Data::getCarAttibutes($value->id_car),
               );
           }
           return $data;
       }else{
           return array();
       }

    }
    public function which_period($day)
    {
        if ($day <= 3) {
            $this->period = "period1";
        } else if ($day > 3 && $day <= 7) {
            $this->period = "period2";
        } else if ($day > 7 && $day <= 10) {
            $this->period = "period3";
        } else if ($day > 10 && $day <= 14) {
            $this->period = "period4";
        } else if ($day > 14 && $day <= 21) {
            $this->period = "period5";
        } else if ($day > 21 && $day <= 29) {
            $this->period = "period6";
        } else if ($day >= 30) {
            $this->period = "period7";
        }
    }
    public static function getCarInfo($id_car)
    {
        $car   = Car::find($id_car);
        $brand =  Brand::find($car->brand)->brandname ?? null;
        $model =  CarModel::find($car->model)->modelname ?? null;
        $year  =  $car->year;
        return $brand." ".$model;
    }



}
