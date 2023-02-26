<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class BlogLanguage extends Base
{
   public static function getSelectLang(int $id,string $field,int $id_lang)
   {
     return  DB::table("blog_languages")->where("id_blog",$id)->where("id_lang",$id_lang)->first()->$field ?? null;
   }

    public static function getImage(int $id)
    {
        return  DB::table("blogs")->where("id",$id)->first()->image;
    }



}
