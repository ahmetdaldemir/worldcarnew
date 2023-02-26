<?php namespace App\Repositories\Plate;

use App\Models\Plate;
use App\Models\Reservation;
use Carbon\Carbon;


class PlateRepository implements PlateRepositoryInterface
{

    public function get($id)
    {
        return Plate::find($id);
    }

    public function all()
    {
        return Plate::where("status", '!=', Plate::PLATE_STATUS_ARCHIVE)->where("status", '!=', Plate::PLATE_STATUS_CRASHED)->get()->sortBy(function($query){
            return $query->car->brand;
        })->all();

    }

    public function getAvaibleAll(Reservation $reservation)
    {

        $reservations = [];

/*        $result1 = \DB::select("SELECT p.*,r.checkin,r.checkout,r.checkin_time,r.checkout_time
            FROM plates p
            LEFT JOIN (SELECT r.*  FROM reservations r
            WHERE r.checkout  >= '" . Carbon::parse($reservation->checkin)->format('Y-m-d') . "' and r.checkin  <= '" . Carbon::parse($reservation->checkout)->format('Y-m-d') . "')  AS r ON p.id = r.plate
            where  r.plate is not null and r.status IN ('comfirm','waiting')");
*/

        $result1 = \DB::select("SELECT  p.id as plateid,r.id,r.checkin,r.checkout,r.checkin_time,r.checkout_time
FROM reservations r INNER JOIN plates p ON p.id = r.plate
WHERE r.checkout  >= '" . Carbon::parse($reservation->checkin)->format('Y-m-d') . "' and r.checkin  <= '" . Carbon::parse($reservation->checkout)->format('Y-m-d') . "' and r.plate is not null and r.status IN ('new','waiting','comfirm')");


        foreach ($result1 as $item) {
           if($item->checkout != $reservation->checkin or ($item->checkout == $reservation->checkin and $item->checkout_time >= $reservation->checkin_time)){
                 $reservations[] = $item->plateid;
            }
        }
        if (!is_null($reservations)) {
            $plates = $this->getNotIn($reservations);
        } else {
            $plates = $this->all();
        }
        return $plates;
    }

    public function getNotIn(array $reservations)
    {
        return Plate::where("status", '!=', Plate::PLATE_STATUS_ARCHIVE)->where("status", '!=', Plate::PLATE_STATUS_CRASHED)->whereNotIn('id', $reservations)->get()->groupBy(function($query){
            return $query->car->model;
        })->all();
    }

    public function getIn(array $reservations)
    {
        return Plate::where("status", '!=', Plate::PLATE_STATUS_ARCHIVE)->where("status", '!=', Plate::PLATE_STATUS_CRASHED)->whereIn('id', $reservations)->get()->sortBy(function($query){
            return $query->car->model;
        })->all();
    }

    public function getNotInTest(array $reservations)
    {
        return Plate::where("status", '!=', Plate::PLATE_STATUS_ARCHIVE)->where("status", '!=', Plate::PLATE_STATUS_CRASHED)->whereNotIn('id', $reservations)->get()->sortBy(function($query){
            return $query->car->model;
        })->all();
    }

    public function delete($id)
    {
        Plate::destroy($id);
    }


    public function create(object $data)
    {

        $Plate = new Plate();
        $Plate->firstname =  $data->firstname;
        $Plate->lastname =  $data->lastname;
        $Plate->email =  $data->email;
        $Plate->phone =  $data->phone;
        $Plate->Plate =  $data->Plate;
        $Plate->save();
    }

    public function update(object $data)
    {
        Plate::find($data->id)->update($data);
    }
}
