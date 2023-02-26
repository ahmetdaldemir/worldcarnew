<?php

namespace App\Jobs;

use App\Mail\SiteSendMail;
use App\Repositories\Message\MessageRepositoryInterface;
use App\Repositories\View\Customer\CustomerRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SiteMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    protected $data;

    protected MessageRepositoryInterface $messageRepository;

    public function __construct($data)
    {
        $this->data = $data;
    }


    public function handle()
    {

        $to_name = 'Ahmet';
        $to_email = 'ahmetdaldemir@gmail.com';
        $data = array('name'=>"Sam Jose", "body" => "Test mail");
        Mail::send('email.invitation-email', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject('Artisans Web Testing Mail');
            $message->from('worldrentalanya@gmail.com','Artisans Web');
        });
        dd('send mail successfully !!');
    }
}
