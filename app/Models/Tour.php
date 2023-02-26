<?php namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Psy\Util\Json;

class Tour extends Model
{
    use HasFactory;
    protected $casts = [
        'tour_days' => 'array',
    ];

}

class TourLanguage extends Model
{
    use HasFactory;

    public static function getSelectLang(int $id,string $field,int $id_lang)
    {
        $x =  DB::table("tour_languages")->where("tour_id",$id)->where("lang_id",$id_lang);
        if($x->count() > 0)
        {
            return $x->first()->$field;
        }
    }


}
