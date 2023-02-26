<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobilSliderLanguage extends Model
{
    use HasFactory;

    public static function getSelectLang(int $id,string $field,int $id_lang)
    {
        return  DB::table("mobil_slider_languages")->where("mobil_slider_id",$id)->where("lang_id",$id_lang)->first()->$field ?? null;
    }

}
