<?php

use App\Helpers\Helper;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;

if (!function_exists('phonereplace')) {
    /**
     * Format number
     *
     * @param $value
     * @param $attribute
     * @param $data
     * @return boolean
     */
    function phonereplace()
    {

        $country =  Country::where("country_name",Auth::guard('web')->user()->nationality)->first();
        $phone = Auth::guard('web')->user()->phone;
        return Helper::replacePhone($country,$phone);
    }

}

