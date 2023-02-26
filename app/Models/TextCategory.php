<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TextCategory extends Base
{
    public function getLangTitle()
    {
        return TextCategoryLanguage::where('id_lang',1)->where('id_text_category',$this->id)->first()->title;
    }
    public function getLangTitleView($langID)
    {
        return TextCategoryLanguage::where('id_lang',$langID)->where('id_text_category',$this->id)->first()->title;
    }
    public function getTextTitle($langID)
    {
        return TextLanguage::where('id_lang',$langID)->where('category',$this->id)->first()->title;
    }

    public function getLangViewAllTitle($lang)
    {
        $ids=  Text::where('category',$this->id)->pluck('id');
        return TextLanguage::where('id_lang',$lang)->whereIn('id_text',$ids)->get();
    }


}
