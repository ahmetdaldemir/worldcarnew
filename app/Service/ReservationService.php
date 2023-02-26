<?php


namespace App\Service;


use App\Repository\Data;
use App\Models\Brand;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\Customer;
use App\Models\Reservation;
use App\Models\ReservationEkstra;
use App\Models\ReservationInformation;
use App\Models\ReservationInvoice;
use App\Models\ReservationPayment;

class ReservationService
{
    public function get_data(int $id)
    {

        $reservation = Reservation::find($id);
        $reservationInformation = ReservationInformation::where("id_reservation", $id)->first();
        $reservationInvoice = ReservationInvoice::where("id_reservation", $id)->first();
        $reservationPayment = ReservationPayment::where("id_reservation", $id)->first();
        $reservationEkstra = ReservationEkstra::where("id_reservation", $id)->first();

        $data = array(
            'car' => Data::getCarInfo($reservation->car),
            'fullname' => $reservation->firstname . " " . $reservation->lastname,
            'customerInfo' => Customer::find($reservation->id_customer),
            'nationality' => $reservation->nationality,
            'pnrNo' => "PNR0" . $id,
            'reservationInformation' => $reservationInformation,
            'reservationInvoice' => $reservationInvoice,
            'reservationPayment' => $reservationPayment,
            'reservationEkstra' => $reservationEkstra,
        );
        return $data;
    }
}
