<?php namespace App\Repositories\Reservation;

use App\Models\Reservation;


class ReservationRepository implements ReservationRepositoryInterface
{

    public function get($id)
    {
        return Reservation::find($id);
    }

    public function all()
    {
        return Reservation::where("status", '!=', Reservation::Reservation_STATUS_ARCHIVE)->get()->sortBy(function($query){
            return $query->car->brand;
        })->all();

    }

    public function getNotIn(array $reservations)
    {
        return Reservation::where("status", '!=', Reservation::Reservation_STATUS_ARCHIVE)->whereNotIn('id', $reservations)->get()->sortBy(function($query){
            return $query->car->brand;
        })->all();
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
