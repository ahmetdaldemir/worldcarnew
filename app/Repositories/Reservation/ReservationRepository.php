<?php namespace App\Repositories\Reservation;

use App\Models\Reservation;
use Carbon\Carbon;


class ReservationRepository implements ReservationRepositoryInterface
{

    public function get($id)
    {
        return Reservation::find($id);
    }

    public function all()
    {
       return Reservation::all();
    }

    public function getindex()
    {
           return Reservation::where('status', '!=', 'closed')
           ->whereDate('checkin', '>=', Carbon::today())
           ->whereNull('deleted_at')
           ->orderBy('checkin', "asc")
           ->orderBy('checkin_time', "asc")
           ->paginate(50);
    }
    public function getdelete()
    {
        return  Reservation::whereNotNull('deleted_at')->orderBy('checkin', "asc")->orderBy('checkin_time', "asc")->get();
    }
    public function getcustomer($id)
    {
       return  Reservation::where('id_customer', $id)->orderBy('checkin', "asc")->get();
    }
    public function getstatus($status)
    {
        return Reservation::where('status', $status)->orderBy('checkin', "asc")->orderBy('checkin_time', "asc")->paginate(10);
    }
    public function getnoncomfirm($status)
    {
        return Reservation::whereNull('deleted_at')->where('status', Reservation::RESERVATION_STATUS_WAIT)->orderBy('checkin', "asc")->orderBy('checkin_time', "asc")->get();
    }
    public function getnewcomfirm()
    {
        return Reservation::whereNull('deleted_at')->where('status', Reservation::RESERVATION_STATUS_NEW)->orderBy('checkin', "asc")->orderBy('checkin_time', "asc")->get();
    }
    public function delete($id)
    {
        Reservation::destroy($id);
    }
    public function create(object $data)
    {

        $Reservation = new Reservation();
        $Reservation->firstname =  $data->firstname;
        $Reservation->lastname =  $data->lastname;
        $Reservation->email =  $data->email;
        $Reservation->phone =  $data->phone;
        $Reservation->Reservation =  $data->Reservation;
        $Reservation->save();
    }
    public function update(object $data)
    {
        Reservation::find($data->id)->update($data);
    }
}
