<?php

namespace App\Console\Commands;

use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Console\Command;

class Reminding extends Command
{

    protected $signature = 'command:reminding';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $dt = Carbon::now();
        $dttime = $dt->subHours(6);
        $reservations = Reservation::where("status",'comfirm')->where("checkin",$dt->format('Y-m-d'))->get();
        if($reservations)
        {
            foreach($reservations as $item)
            {
                $info = $item->reservationInformation->where('checkin_time', '>' , $dttime->format('H:i:s'))->first();
                if($info)
                {
                    $this->dispatch(new \App\Jobs\Reminding($item))->onQueue('reminding');
                }
            }
        }
    }
}
