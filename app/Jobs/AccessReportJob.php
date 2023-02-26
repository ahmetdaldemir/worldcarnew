<?php

namespace App\Jobs;

use App\Models\AccessReport as AccessReportModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
 use Browser;
use Spatie\Referer\Referer;

class AccessReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($type="")
    {
        $path = explode("/", request()->getPathInfo());
        $accessreport = new AccessReportModel();

                $accessreport->language_id = $path[1];
                $accessreport->ip          = request()->ip();
                $accessreport->url         = url()->full();
                $accessreport->referer     = $_SERVER['HTTP_REFERER'] ?? "Bulunamadı";
                $accessreport->modelname   = static::class;
                $accessreport->country     = $_SERVER["HTTP_CF_IPCOUNTRY"]??"TR";
                $accessreport->platform    = Browser::deviceFamily();
                $accessreport->type        = $type ?? "normal";
                $accessreport->save();
     }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
    }
}
