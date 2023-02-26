<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Base
{

    public static function getCategoryLanguage($id, $language)
    {
        return CategoryLanguage::where('id_categories', $id)->where('id_lang', $language)->get();
    }


    public function language_admin()
    {
        return CategoryLanguage::where('id_categories', $this->id)->where('id_lang', 1)->first();
    }


}
