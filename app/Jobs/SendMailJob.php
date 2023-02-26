<?php

namespace App\Jobs;

use App\Mail\ComfirmMail;
use App\Models\Customer;
use App\Models\EmailTemplate;
use App\Models\Plate;
use App\Models\Reservation;
use App\Models\ReservationEmail;
use App\Models\ReservationNote;
use App\Repository\Car;
use App\Service\PdfService;
use App\Service\Search;
use App\Traits\HasErrors;
use Firebase\JWT\JWT;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels,HasErrors;


    public function __invoke()
    {
        // TODO: Implement __invoke() method.
    }

    public function __construct(Reservation $reservation, $request)
    {
        $data['reservation'] = $reservation;
        $data['user_language_id'] = $reservation->customer->language;
        $template = EmailTemplate::where('language_id', $reservation->customer->language)->where('email_template_id', $request->template_id)->first();
        $data['template'] = $template;
        $to_name = $reservation->customer->fullname;
        $to_email = $request->email;
        $data['request'] = $request->request;
        $data['ekstraMessage'] = $request->ekstraMessage;

        $data['encode'] = $reservation->comfirm_token;
        if($request->status == "comfirm")
        {
            $reservation->status = Reservation::RESERVATION_STATUS_WAIT;
            $reservation->save();
        }


        if($request->status == "closed")
        {
            $reservation->status = Reservation::RESERVATION_STATUS_CLOSED;
            $reservation->save();

            $reservationnote = new ReservationNote();
            $reservationnote->type="closed";
            $reservationnote->sender="manager";
            $reservationnote->id_reservation = $reservation->id;
            $reservationnote->messages = $request->ekstraMessage ?? "İptal Edildi";
            $reservationnote->save();
        }
        Mail::send('email.'.$request->file, $data, function ($message) use ($to_name, $to_email,$reservation,$request,$template) {
            if($request->template_id != 9)
            {
                $message->to($to_email, $to_name)->subject($template->title);
            }else{
                $message->to($to_email, $to_name)->subject($request->subject);
            }
            $message->from('info@worldcarrental.com', 'World Car Rental');
            $message->cc('worldrentalanya@gmail.com', 'World Car Rental');
            $attachment = $this->createPdf($reservation);
            $message->attach($attachment);
//            if (file_exists(storage_path() . "/pdf/" . $reservation->pnr . '.pdf')) {
//                $attachment = storage_path()."/pdf/".$reservation->pnr.'.pdf';
//                $message->attach($attachment);
//            }else{
//                $attachment = $this->createPdf($reservation);
//                $message->attach($attachment);
//            }
        });
        if (count(Mail::failures()) == 0) {
            $reservationmail = new ReservationEmail();
            $reservationmail->id_reservation = $reservation->id;
            $reservationmail->id_user = Auth::user()->id;
            $reservationmail->status = $request->status;
            $reservationmail->save();
            $reservation->email_send = $request->status;
            $reservation->save();
        }else{
            $this->addError(Mail::failures());
        }
    }


    public function createPdf(Reservation $reservation)
    {

        $this->reservation = $reservation;
        $this->password = "";
        $this->user_language_id = $reservation->customer->language;
        $file="invitation-email";

        $dropLocation = $reservation->reservationInformation['drop_location'];
        if ($reservation->reservationInformation['drop_location'] == null) {
            $dropLocation = $reservation->reservationInformation['up_location'];
        }
        $car = new Car();
        $data['reservation'] = $reservation;
        $data['aciklama'] = "Deneme";
        $data['fullname'] = $reservation->reservationInformation->firstname." ".$reservation->reservationInformation->lastname;
        $data['customer_id'] = $reservation->customer->id;
        $data['phone'] = $reservation->customer->phone;
        $data['nationality'] = $reservation->reservationInformation->nationality;
        $data['email'] = $reservation->customer->email;
        $data['pnr'] = $reservation->pnr;
        $data['plate'] = ($reservation->plate != NULL) ? $reservation->getPlate->plate :"Atanmadı";
        $data['car'] = ($reservation->plate != NULL) ? $car->getCar($reservation->getPlate->id_car):$car->getCar($reservation->car);
        $data['reservationInfo'] = $reservation->reservationInformation;
        $data['payment_type'] = $reservation->payment_type;
        $data['currency'] = $reservation->reservationCurrency->right_icon;
        $data['reservationEkstras'] = $reservation->reservationEkstras;
        $data['uplocation'] = Search::getLocationName($reservation->reservationInformation['up_location']);
        $data['mainuplocation'] = Search::getLocationParentName($reservation->reservationInformation['up_location']);
        $data['maindownlocation'] = Search::getLocationParentName($dropLocation);
        $data['downlocation'] = Search::getLocationName($dropLocation);
        $data['file'] = "email.".$file;
        $data['image'] = ($reservation->plate != NULL) ? $this->getImage($reservation->plate):$reservation->reservationCar->default_images;
        $data['password'] = $this->password;
        $data['user_language_id'] = $this->user_language_id;
        $files = "email.".$file;
        $customer = Customer::find($reservation->id_customer);
        $to_name = $customer->fullname;
        $to_email = $customer->email;
        $template = EmailTemplate::where('language_id',$this->user_language_id)->where('email_template_id',7)->first();
        $data['template'] = $template;
        $pdf = new PdfService($data);
        return storage_path()."/pdf/".$this->reservation->pnr.'.pdf';
    }

    public function getImage($id)
    {
      $plate =  Plate::find($id);
      return $plate->car->default_images;
    }
}

