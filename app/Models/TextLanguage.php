<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class TextLanguage extends Base
{
    public static function getSelectLang(int $id,string $field,int $id_lang)
    {
        return  DB::table("text_languages")->where("id_text",$id)->where("id_lang",$id_lang)->first()->$field;
    }

    public static function getImage(int $id)
    {
        $x =  DB::table("texts")->where("id",$id);
        if($x->count() > 0)
        {
           return $x->first()->file;
        }

    }


    public static function getHeaderImage(int $id)
    {
        $x =  DB::table("texts")->where("id",$id);
        if($x->count() > 0)
        {
            return $x->first()->header;
        }


    }



}
