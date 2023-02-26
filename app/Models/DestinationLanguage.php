<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;


class DestinationLanguage extends Base
{
    public static function getSelectLang(int $id,string $field,int $id_lang)
    {
        return  DB::table("destination_languages")->where("id_destination",$id)->where("id_lang",$id_lang)->first()->$field ?? null;
    }

    public static function getImage(int $id)
    {
        return  DB::table("destinations")->where("id",$id)->first()->image;
    }

    public function images()
    {
        return Image::where('model','destinations')->where('model_id',$this->id_destination)->first();
    }
}
