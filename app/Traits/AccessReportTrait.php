<?php namespace App\Traits;

use App\Models\BrowserDetect as BrowserDetectModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Spatie\Referer\Referer;
use \App\Models\AccessReport as AccessReportModel;
use Browser;

trait AccessReportTrait
{
    public  function __construct()
    {
        $path = explode("/", request()->getPathInfo());
        $accessreport = new AccessReportModel();
        $accessreport->language_id  =  $path[1];
        $accessreport->ip  =  request()->ip();
        $accessreport->country  =  $_SERVER["HTTP_CF_IPCOUNTRY"]??"TR";
        $accessreport->url  =  url()->full();
        $accessreport->referer  =   app(Referer::class)->get();
        $accessreport->modelname  =  static::class;
        $accessreport->platform = Browser::isMobile();
        $accessreport->token =  csrf_token();
        $accessreport->save();
    }

}
