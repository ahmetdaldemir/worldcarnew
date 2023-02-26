<?php namespace App\Service\Dashboard;


use App\Models\Reservation;
use App\Models\ReservationOperation;
use Carbon\Carbon;

class Comeback
{
    public function handle()
    {
        return Reservation::whereNotNull('up_date')->whereNull('drop_date')->orWhere('drop_date','0000-00-00')->orderBy('id','desc')->get()->take(10);
    }

    public function totalUp()
    {
        $reservations = Reservation::where('status','!=','complated')->where('checkout','<',date('Y-m-d'))->pluck('id');
        return ReservationOperation::whereIn('id_reservation',$reservations)->whereNotIn('type',array('drop','up'))->count();
    }

    public function totalUpList()
    {
        $reservations = Reservation::where('status','!=','complated')->where('checkout','<',date('Y-m-d'))->pluck('id');
        $id_reservationlist =  ReservationOperation::whereIn('id_reservation',$reservations)->whereNotIn('type',array('drop','up'))->pluck('id_reservation');
        return Reservation::whereIn('id',$id_reservationlist)->get();
    }


    public function totalMountReservation()
    {
        return Reservation::where('status','!=','closed')->whereMonth('created_at', Carbon::now()->month)->count();
    }

    public function totalDayReservation()
    {
        return Reservation::where('status','!=','closed')->whereDate('created_at', Carbon::now())->count();
    }

    public function totalReservation()
    {
        return Reservation::where('status','!=','closed')->count();
    }

    public function totalDay()
    {
        return Reservation::where('status','!=','closed')->count('days');
    }


}
