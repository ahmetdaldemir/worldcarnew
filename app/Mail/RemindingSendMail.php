<?php

namespace App\Mail;

use App\Models\Language;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RemindingSendMail extends Mailable
{
    use Queueable, SerializesModels;


    public $language;
    public $customer;


    public function __construct(Customer $customer, Language $language)
    {
        $this->customer = $customer;
        $this->language = $language;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $customer = $this->customer;
        $language = $this->language;
        return $this->view('email.reminding',compact('customer','language'));
    }
}
