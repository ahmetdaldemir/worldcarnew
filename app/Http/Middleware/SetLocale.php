<?php


namespace App\Http\Middleware;


use Closure;

class SetLocale
{
    public function handle($request, Closure $next)
    {
         $location = $request->segment(1);
        if($request->segment(1) == null)
        {
            $ip = \request()->ip();
            $data = \Location::get($ip);
            switch ($data->countryCode) {
                case "TR":
                    $location = 'tr';
                    break;
                case "DE":
                    $location = 'de';
                    break;
                case "RU":
                    $location = 'ru';
                    break;
                default:
                    $location = 'en';
            }
        }

        app()->setLocale($location);
        return $next($request);
    }

}
