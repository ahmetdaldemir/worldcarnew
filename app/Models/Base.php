<?php namespace App\Models;

use App\Jobs\AccessReportJob;
use App\Traits\BrowserDetect;
use App\Traits\ModelLog;
use App\Traits\ReservationLogTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Base extends  Model
{
   use LogsActivity,ModelLog;


    public function getActivitylogOptions(): LogOptions
    {
       return LogOptions::defaults()->submitEmptyLogs();
    }
}
