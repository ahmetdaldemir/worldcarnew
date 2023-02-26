<?php

namespace App\Jobs;

use App\Mail\BirthdaySendMail;
use App\Mail\SendMail;
use App\Mail\SurveySendMail;
use App\Models\EmailTemplate;
use App\Models\Reservation;
use App\Models\Customer;
use App\Models\ReservationEmail;
use App\Models\ReservationNote;
use App\Repository\Car;
use Firebase\JWT\JWT;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Service\Search;
use App\Traits\ReservationLogTrait;
use Twilio\Rest\Client;
class Survey implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, ReservationLogTrait;


    public function __construct(Reservation $reservation)
    {
        $data['reservation'] = $reservation;
        $data['user_language_id'] = $reservation->customer->language;
        $template = EmailTemplate::where('language_id', $reservation->customer->language)->where('email_template_id', 10)->first();
        $data['template'] = $template;
        $to_name = $reservation->customer->fullname;
        $to_email = $reservation->customer->email;
        $data['encode'] = $reservation->comfirm_token;


        Mail::send('email.survey', $data, function ($message) use ($to_name, $to_email,$data,$template) {
            $message->to($to_email, $to_name)->subject($template->title);
            $message->from('info@worldcarrental.com', 'World Car Rental');
            $message->cc('ahmetdaldemir@gmail.com', 'World Car Rental');
            $message->bcc('worldrentalanya@gmail.com', 'World Car Rental');
         });


//        $tokendata = array(
//            'customer_id' => $reservation->id_customer,
//            'reservation_id' => $reservation->id,
//        );
//        $token =   JWT::encode($tokendata, "worldcar");
//        $email = new SurveySendMail($reservation,$token);
//        Mail::to()->cc('worldrentalanya@gmail.com')->subject('Mini Anket Çalışması')->send($email);
     }

 }

