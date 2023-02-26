<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;


class EkstraLanguage extends Base
{
    public static function getSelectLang(int $id,string $field,int $id_lang)
    {
        return  DB::table("ekstra_languages")->where("id_ekstra",$id)->where("id_lang",$id_lang)->first()->$field ?? null;
    }

    public static function getImage(int $id)
    {
        return  DB::table("ekstras")->where("id",$id)->first()->image;
    }


}
