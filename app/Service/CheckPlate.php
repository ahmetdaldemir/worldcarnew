<?php

namespace App\Service;

use App\Models\Plate;
use App\Models\Reservation;
use Carbon\Carbon;

class CheckPlate
{


    public function handle(Plate $plate,$props)
    {
        $thisTime = Carbon::parse($this->up_time)->timestamp;
        $x = \DB::select("select * from reservations where
                                  plate = $this->plate_id
                             and  checkout >= '" . Carbon::parse($this->up_date)->format('Y-m-d') . "'
                             and  checkin <= '" . Carbon::parse($this->drop_date)->format('Y-m-d') . "'
                             and status IN ('comfirm','waiting') and deleted_at IS NULL LIMIT 1 ");

        if (!empty($x)) {
            foreach ($x as $item) {
                $resTime = Carbon::parse($item->checkout_time)->timestamp;
                if (($item->checkout == Carbon::parse($this->up_date)->format("Y-m-d")) && ($thisTime >= $resTime)) {
                    return $this->plate_id;
                }
            }

        } else {
            return $this->plate_id;
        }
    }



    public function getId(Reservation $reservation,$newCheckOutDate,$newCheckOutTime)
    {
        if(is_null($reservation->plate))
        {
            return "1";
        }
        $thisTime = Carbon::parse($newCheckOutTime)->timestamp;
        $x = \DB::select("select * from reservations where
                                  plate = $reservation->plate
                             and  checkout >= '" . Carbon::parse($reservation->checkin)->format('Y-m-d') . "'
                             and  checkin <= '" . Carbon::parse($newCheckOutDate)->format('Y-m-d') . "'
                             and status IN ('comfirm','waiting') and deleted_at IS NULL LIMIT 1 ");

        if (!empty($x)) {
            foreach ($x as $item) {
                $resTime = Carbon::parse($item->checkout_time)->timestamp;
                if (($item->checkout == Carbon::parse($this->up_date)->format("Y-m-d")) && ($thisTime >= $resTime)) {
                    return "0";
                }else{
                    return "1";
                }
            }

        } else {
            return "1";
        }
    }
}
