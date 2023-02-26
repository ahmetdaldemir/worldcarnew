<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Text extends Base
{



    public function getCategoryName()
    {
        return TextCategoryLanguage::where('id_lang',1)->where('id_text_category',$this->category)->first()->title ?? "BULUNAMADI.".$this->category."";
    }

    public function getLangTitle()
    {
       return TextLanguage::where('id_lang',1)->where('id_text',$this->id)->first()->title;
    }

    public function getLangViewTitle($lang)
    {
       return TextLanguage::where('id_lang',$lang)->where('id_text',$this->id)->first()->title;
    }
    public function getLangViewContent($lang)
    {
       return TextLanguage::where('id_lang',$lang)->where('id_text',$this->id)->first()->description;
    }
    public function getLangViewSlug($lang)
    {
       return TextLanguage::where('id_lang',$lang)->where('id_text',$this->id)->first()->slug;
    }


}
