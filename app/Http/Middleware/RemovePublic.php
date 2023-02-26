<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;

class RemovePublic
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $searchFor="public";
        $strPosition=strpos($request->fullUrl(), $searchFor);
        if ($strPosition!==false) {
           $url = str_replace('public/','',$request->fullUrl());

            return Redirect::to($url);
        }
        return $next($request);
    }
}
