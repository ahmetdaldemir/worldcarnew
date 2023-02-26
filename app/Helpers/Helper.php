<?php


namespace App\Helpers;


use App\Models\Country;
use Illuminate\Support\Facades\Auth;

class Helper
{

   static function replaceSpace($string)
    {
        $sitring = preg_replace('/\%/',' percentage',$string);
        $sitring = preg_replace('/\@/',' at ',$sitring);
        $sitring = preg_replace('/\&/',' and ',$sitring);
        $sitring = preg_replace('/\s[\s]+/','',$sitring);    // Strip off multiple spaces
        $sitring = preg_replace('/[\s\W]+/','',$sitring);    // Strip off spaces and non-alpha-numeric
        $sitring = preg_replace('/^[\-]+/','',$sitring); // Strip off the starting hyphens
        $sitring = preg_replace('/[\-]+$/','',$sitring); // // Strip off the ending hyphens

        return $sitring;
    }


    static function replacePhone($country,$phone)
    {


        if(strstr($phone, "+") || strstr($phone, "00"))
        {
            $string = substr($phone, 0,2);
            $stringabs = substr($phone, 0,1);

                if($string == "00")
                {
                    $strings = substr($phone, 2);
                    $phoneNumber = str_replace($country->phone_code, " ",$strings);
                    return $phoneNumber;
                }else if($stringabs == "+")
                {
                    $string = str_replace('+'.$country->phone_code, " ",$phone);
                    return $string;
                }else{
                    return $phone;
                }
            }else{
                     return $phone;
            }
    }

    public static function authphonereplace()
    {
        if(Auth::guard('web')->check())
        {
            $country =  Country::where("country_name",Auth::guard('web')->user()->nationality)->first();
            $phone = Auth::guard('web')->user()->phone;
            return  Helper::replacePhone($country,$phone);

        }

    }


}
