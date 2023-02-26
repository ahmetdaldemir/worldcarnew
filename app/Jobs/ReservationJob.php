<?php

namespace App\Jobs;

use App\Mail\SendMail;
use App\Models\Ekstra;
use App\Models\EmailTemplate;
use App\Models\Plate;
use App\Models\Reservation;
use App\Models\Customer;
use App\Repository\Car;
use App\Service\PdfService;
use Firebase\JWT\JWT;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Service\Search;
use App\Traits\ReservationLogTrait;
use Illuminate\Support\Facades\Session;
use Twilio\Rest\Client;
use Redis;

class ReservationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, ReservationLogTrait;

    protected $reservation;
    protected $aciklama;

    public function __construct($emailsend = 1)
    {
        $seession = Session::all();

        $this->redis = new Redis();
        $this->redis->connect('localhost', 6379);
        $redis_data = json_decode($this->redis->get($seession['_token']), true);
        $this->reservation = $redis_data['reservation'];
        $this->password = $redis_data['password'];
        $this->user_language_id = $redis_data['user_language_id'];
        $file="invitation-email";
        $reservationdata = Reservation::find($this->reservation['id']);

          $dropLocation = $reservationdata->reservationInformation['drop_location'];
          if ($reservationdata->reservationInformation['drop_location'] == null) {
              $dropLocation = $reservationdata->reservationInformation['up_location'];
          }
          $car = new Car();
          $data['reservation'] = $reservationdata;
          $data['aciklama'] = "Deneme";
          $data['fullname'] = $reservationdata->reservationInformation->firstname." ".$reservationdata->reservationInformation->lastname;
          $data['customer_id'] = $reservationdata->customer->id;
          $data['phone'] = $reservationdata->customer->phone;
          $data['nationality'] = $reservationdata->customer->nationality;
          $data['email'] = $reservationdata->customer->email;
          $data['pnr'] = $reservationdata->pnr;
          $data['plate'] = ($reservationdata->plate != NULL) ? $reservationdata->getPlate->plate :"Atanmadı";
          $data['car'] = ($reservationdata->plate != NULL) ? $car->getCar($reservationdata->getPlate->id_car):$car->getCar($reservationdata->car);
          $data['reservationInfo'] = $reservationdata->reservationInformation;
          $data['payment_type'] = $reservationdata->payment_type;
          $data['currency'] = $reservationdata->reservationCurrency->right_icon;
          $data['reservationEkstras'] = $reservationdata->reservationEkstras;
          $data['uplocation'] = Search::getLocationName($reservationdata->reservationInformation['up_location']);
          $data['mainuplocation'] = Search::getLocationParentName($reservationdata->reservationInformation['up_location']);
          $data['maindownlocation'] = Search::getLocationParentName($dropLocation);
          $data['downlocation'] = Search::getLocationName($dropLocation);
          $data['file'] = "email.".$file;
          $data['password'] = $this->password;
          $data['image'] = ($reservationdata->plate != NULL) ? $this->getImage($reservationdata->plate):$reservationdata->reservationCar->default_images;

        $data['user_language_id'] = $this->user_language_id;
           $files = "email.".$file;
          $customer = Customer::find($reservationdata->id_customer);
          $to_name = $customer->fullname;
          $to_email = $customer->email;
          $template = EmailTemplate::where('language_id',$this->user_language_id)->where('email_template_id',7)->first();
          $data['template'] = $template;

          $pdf = new PdfService($data);
          $attachment = storage_path()."/pdf/".$this->reservation['pnr'].'.pdf';

          if($emailsend == 1)
          {
              Mail::send("email.reservation", $data, function ($message) use ($to_name, $to_email,$template,$attachment) {
                  $message->to($to_email, $to_name)->subject($template->title);
                  $message->from('info@worldcarrental.com', 'World Car Rental');
                  $message->cc('worldrentalanya@gmail.com', 'World Car Rental');
                  $message->attach($attachment);
              });
          }



        if(count(Mail::failures()) == 0)
        {
            $this->redis->del($seession['_token']);
            $reservationdata->email_send = 1;
            $reservationdata->save();
        }elseif (count(Mail::failures()) > 0){
            //$this->saveLogReservation($data['file'], $reservation, $request,"","Mail Gönderilemedi");
        }
     }

    public function getImage($id)
    {
        $plate =  Plate::find($id);
        $car = \App\Models\Car::find($plate->id_car);
        return $car->default_images;
    }
 }

