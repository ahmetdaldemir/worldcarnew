<?php


namespace App\Traits;


use Browser;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\BrowserDetect as BrowserDetectModel;

trait BrowserDetect
{
    protected $uuid;

   public function __construct()
   {
       if(Session::has('uuid'))
       {
           $this->uuid = Session::get('uuid');
       }else{
           $this->uuid = Str::uuid();
           Session::put(['uuid' => $this->uuid]);
       }

       $flight = BrowserDetectModel::firstOrCreate(
           ['uuid' => $this->uuid,'created_at' => Carbon::now()->format('Y-m-d H:i:s'),'model' => static::class],
           ['url_current' => url()->full(), 'user_id' => Auth::guard('web')->id(),'ip_address' => request()->ip(),'browser'=>Browser::browserFamily()]
       );
   }
}
