<?php

namespace App\Mail;

use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SiteSendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct(Request $request)
    {
        $data['data'] = $request;
         $to_name = $request->firstname ." ".$request->lastname;
        $to_email = $request->email;
        Mail::send('email.base', $data, function($message) use ($to_name, $to_email) {
            $message->to('worldrentalanya@gmail.com',"Siteden Mail Geldi");
            $message->cc('info@worldcarrental.com',"Siteden Mail Geldi");
            $message->from($to_email, $to_name)->subject('Siteden Mail Geldi');
        });
     }
    public function __invoke()
    {
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

    }
}
