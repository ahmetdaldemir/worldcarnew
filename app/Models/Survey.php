<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Base
{
    use HasFactory;


    public function survey_language()
    {
        return $this->belongsTo(SurveyLanguage::class,'id','survey_id');
    }

     public function surveyquestion()
    {
        $langId = Language::where("url", app()->getLocale())->first()->id;
        return  SurveyLanguage::where('lang_id',$langId)->where('survey_id',$this->id)->first();
    }

    public function surveyanswer()
    {
        $langId = Language::where("url", app()->getLocale())->first()->id;
        return  AnswerLanguage::where('lang_id',$langId)->where('survey_id',$this->survey_id)->get();
    }
    public function surveylanguageedit($langId)
    {
        return SurveyLanguage::where('lang_id',$langId)->where('survey_id',$this->id)->first();
    }

}

