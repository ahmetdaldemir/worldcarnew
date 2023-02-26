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
class BasicMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, ReservationLogTrait;

    protected $reservation;
    protected $aciklama;

    public function __construct(Reservation $reservation, $aciklama = "Deneme",$request)
    {
          $file ="email.comment-email";
          $data['file'] = $file;
          $data['messages'] = $request->messages;
          $customer = Customer::find($reservation->id_customer);
          $to_name = $customer->fullname;
          $to_email = $customer->email;
          Mail::send("email.comment-email", $data, function ($message) use ($to_name, $to_email) {
                 $message->to($to_email, $to_name)->subject('World Rent A Car Reservation Mail');
                 $message->from('worldrentalanya@gmail.com', 'World Rent A Car');
                 $message->cc('worldrentalanya@gmail.com', 'World Rent A Car');
             });
     }

 }

