<?php

namespace App\Jobs;

use App\Mail\SendMail;
use App\Models\Reservation;
use App\Models\Customer;
use App\Repository\Car;
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
use Twilio\Rest\Client;
class SendMailSurveyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, ReservationLogTrait;


    public function __construct($request,$reservation)
    {
        $to_name  = $request->fullname;
        $to_email = $request->email;
        $data['customer'] = $request;
        $tokendata = array(
            'customer_id' => $request->id,
            'reservation_id' => $reservation->id,
        );
        $data['token'] =   JWT::encode($tokendata, "worldcar");

        Mail::send("email.survey", $data, function ($message) use ($to_name, $to_email) {
               $message->to($to_email, $to_name)->subject('World Rent A Car Anket Mail');
               $message->from('worldrentalanya@gmail.com', 'World Rent A Car');
               $message->cc('worldrentalanya@gmail.com', 'World Rent A Car');
           });
     }

 }

