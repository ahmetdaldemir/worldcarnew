<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SurveySendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;
    public $token;

    public function __construct($reservation,$token)
    {
        $this->reservation = $reservation;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $reservation = $this->reservation;
        $token = $this->token;
        return $this->view('email.survey',compact('reservation','token'));
    }
}
