<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TextCategoryLanguage extends Base
{
    public function getLangTitle($lang_id)
    {
        return TextCategoryLanguage::where('id_lang',$lang_id)->where('id_text_category',$this->id)->first()->title;
    }


}
