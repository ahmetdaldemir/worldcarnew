<?php

namespace App\Mail;

use App\Traits\HasErrors;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ComfirmMail extends Mailable
{
    use Queueable, SerializesModels,HasErrors;


    protected $data;
    protected $to_name;
    protected $to_email;
    protected $reservation;
    protected $request;
    public function __construct($data)
    {
         $this->data= $data;
         $this->to_name= $data['to_name'];
         $this->to_email= $data['to_email'];
         $this->reservation= $data['reservation'];
         $this->request= $data['request'];
    }



    public function build()
    {


    }


}
