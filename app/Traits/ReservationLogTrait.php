<?php namespace App\Traits;

use App\Models\Reservation;
use \App\Models\ReservationLog as ReservationLogModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

trait ReservationLogTrait
{
    protected static function bootReservationLogTrait() {
    }

    public function saveLogReservation($type,$id,$messages)
    {
        $reservationlog                 = new ReservationLogModel();
        $reservationlog->id_reservation =  $id;
        $reservationlog->type           =  $type;
        $reservationlog->id_user        =  Auth::id();
        $reservationlog->message        =  json_encode($messages);
        $reservationlog->save();
    }

}
