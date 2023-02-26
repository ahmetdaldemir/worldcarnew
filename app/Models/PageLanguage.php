<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PageLanguage extends Base
{
    use HasFactory;

    public static function getSelectLang(int $id,string $field,int $id_lang)
    {
        $a =  DB::table("page_languages")->where("id_pages",$id)->where("id_lang",$id_lang)->first();
        if($a)
        {
            return $a->$field;
        }else{
            return NULL;
        }
    }


    public static function getImage(int $id)
    {
        $x = Image::where("id_module",$id)->where("module","pages");
        if($x->count() > 0)
        {
            return  $x->first()->title;
        }
    }


}
