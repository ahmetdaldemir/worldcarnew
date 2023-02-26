<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class CampingLanguage extends Base
{
    public static function getSelectLang(int $id,string $field,int $id_lang)
    {
         $x =  DB::table("camping_languages")->where("id_camping",$id)->where("id_lang",$id_lang);
         if($x->count() > 0)
         {
            return $x->first()->$field;
         }else{
             return "Data Eklenemedi";
         }
    }


}
