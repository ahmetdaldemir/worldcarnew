<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CategoryLanguage extends Base
{

    use HasFactory;

    protected $fillable = ['id_lang','id_categories','title','slug'];

    public static function getSelectLang(int $id,string $field,int $id_lang)
    {
        $x =  DB::table("category_languages")->where("id_categories",$id)->where("id_lang",$id_lang);
        if($x->count() > 0)
        {
            return $x->first()->$field;
        }
    }


}
