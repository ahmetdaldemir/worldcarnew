<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Redis;

class Location extends Base
{

    public static function getViewCenter()
    {
        $langId = Language::where("url", app()->getLocale())->first();
        $language_id = 1;
        if($langId)
        {
            $language_id = $langId->id;
        }

        $repsonse = DB::table('locations')
            ->join('location_values', 'locations.id', '=', 'location_values.id_location')
            ->where('location_values.id_lang', $language_id)
            ->where('locations.status', 1)
            ->select('locations.*', 'location_values.title')
            ->orderBy('locations.sort', 'asc')
            ->get();
        return $repsonse;

        /*

        $redis = new Redis();
        $redis->connect('localhost', 6379);
        if (!$redis->get('getViewCenter_'.$language_id)) {
            $repsonse = DB::table('locations')
                ->join('location_values', 'locations.id', '=', 'location_values.id_location')
                ->where('location_values.id_lang', $language_id)
                ->where('locations.status', 1)
                ->select('locations.*', 'location_values.title')
                ->orderBy('locations.sort', 'asc')
                ->get();
            $redis->set('getViewCenter_'.$language_id, json_encode($repsonse));

            return $repsonse;
        }else {
            return json_decode($redis->get('getViewCenter_'.$language_id));
        }
        */
    }


    public static function getViewCenterId($id)
    {
        $langId = Language::where("url", app()->getLocale())->first()->id;

        $repsonse = DB::table('locations')
            ->join('location_values', 'locations.id', '=', 'location_values.id_location')
            ->where('location_values.id_lang',$langId)
            ->where('locations.id', $id)
            ->where('locations.status', 1)
            ->select('locations.*', 'location_values.title')
            ->get();
        return $repsonse;
    }

    public static function getViewCenterParentId($id)
    {

        $repsonses = Location::find($id);
        $parent    = LocationValue::where('id_lang', 1)->where('id', $repsonses->id_parent)->first();
        return $parent->title;
    }


    public static function getLanguageValueForLangWithParentId($id,$langId)
    {
        $parent    = LocationValue::where('id_lang', $langId)->where('id_location',$id)->first();
        return $parent;
    }


    public static function getViewCenterInId($id)
    {
        $destination = Camping::find($id);
        $locations = Location::select("id")->whereIn("id",json_decode($destination->destination))->get();
        $repsonse = DB::table('locations')
            ->join('location_values', 'locations.id', '=', 'location_values.id_location')
            ->where('location_values.id_lang', 1)
            ->where('locations.status', 1)
            ->whereIn('locations.id',$locations->pluck("id")->all())
            ->select('locations.*', 'location_values.title')
            ->get();
        return $repsonse;
    }


    public static function getViewLocationId($id)
    {
        $data = array();
        $repsonse = DB::table('locations')
            ->join('location_values', 'locations.id', '=', 'location_values.id_location')
            ->where('location_values.id_lang', 1)
            ->where('locations.id_parent', $id)
            ->where('locations.status', 1)
            ->select('locations.*', 'location_values.title')
            ->get();

        foreach ($repsonse as $val)
        {
            $data[] = array(
                   "name"=>  $val->title,
				   "id"  =>  $val->id,
				   "type"=>  $val->type
            );
        }
        return $data;
    }


    public static function getViewMain()
    {
        $langId = Language::where("url", app()->getLocale())->first()->id;

        $repsonse = DB::table('locations')
            ->join('location_values', 'locations.id', '=', 'location_values.id_location')
            ->where('location_values.id_lang', $langId)
            ->where('locations.status', 1)
            ->where('locations.id_parent', 0)
            ->select('locations.*', 'location_values.title')
            ->orderBy('locations.sort', 'asc')
            ->get();
        return $repsonse;
    }


    public static function getViewLocationName($id)
    {
        $location_values =  LocationValue::where('id_location',$id)->where('id_lang',1)->first();
        if($location_values)
        {
            return $location_values;
        }else{
            return  "Bul.";
        }
    }

    public static function getViewLocationMeta($id)
    {
        $langId = Language::where("url", app()->getLocale())->first()->id;
        $location_values =    LocationValue::where('id_location',$id)->where('id_lang',1)->first()->meta_title;
        return $location_values;
    }

    public function languagevalues()
    {
        return $this->belongsTo(LocationValue::class,'id_location','id');
    }


    public function getName()
    {
        $location_values = LocationValue::where('id_location',$this->id)->where('id_lang',1)->first();
       return $location_values ?? NULL;
    }


}
