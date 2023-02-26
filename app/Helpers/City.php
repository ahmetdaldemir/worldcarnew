<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

use DB;

class City
{
    public static function handle()
    {
       $response = DB::table("city")->get();
       return $response;
    }

    public static function find($id)
    {
        $response = DB::table("city")->where("id",$id)->first();
        return $response;
    }
}
