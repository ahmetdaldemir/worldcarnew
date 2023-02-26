<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;


    public function __construct()
    {

    }



    public function build()
    {
        return $this->subject('Test Mail using Queue in Larvel 8')
            ->view('email.invitation-email');
    }

    public function test()
    {
        $to_name = 'Ahmet';
        $to_email = 'ahmetdaldemir@gmail.com';
        $data = array('name'=>"Sam Jose", "body" => "Test mail");
        Mail::send('email.invitation-email', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject('Artisans Web Testing Mail');
            $message->from('mycarturkey@gmail.com','Artisans Web');
        });
        dd('send mail successfully !!');
    }
}
