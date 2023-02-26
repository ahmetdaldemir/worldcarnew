<?php namespace App\Service\Dashboard;

use App\Models\Reservation;
use App\Models\ReservationOperation;
use Carbon\Carbon;

class Out
{
    public function handle()
    {
        return Reservation::whereNull('up_date')->orWhere('up_date','0000-00-00')->orderBy('id','desc')->get()->take(10);
    }

    public function totalDrop()
    {
        $reservations = Reservation::where('status','!=','complated')->where('checkout','<',date('Y-m-d'))->pluck('id');
        return ReservationOperation::whereIn('id_reservation',$reservations)->whereNotIn('type',array('drop','up'))->count();
    }

    public function totalDropList()
    {
        $reservations = Reservation::where('status','!=','complated')->where('checkin','<',date('Y-m-d'))->pluck('id');
        $id_reservationlist =  ReservationOperation::whereIn('id_reservation',$reservations)->whereNotIn('type',array('drop','up'))->pluck('id_reservation');
        return Reservation::whereIn('id',$id_reservationlist)->get();
    }
}
