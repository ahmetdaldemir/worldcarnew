<?php

namespace App\Jobs;

use App\Mail\BirthdaySendMail;
use App\Models\Customer;
use App\Models\EmailTemplate;
use App\Models\Language;
use App\Traits\HasErrors;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class Birthday implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels,HasErrors;


    public $customer;
    public $language;

    public function __construct($customer)
    {
        $this->customer = Customer::find($customer);
        $this->language = new Language();
        $this->point = 1000;
        $user_language = $this->customer->language ?? 1;
        $template = EmailTemplate::where('language_id', $user_language)->where('email_template_id', 5)->first();
        $data['user_language_id'] = $user_language;
        $data['template'] = $template;
        $data['fullname'] = $this->customer->fullname;
        $to_name = $this->customer->fullname;
        $to_email = $this->customer->email;
        echo"<pre>";
//        $this->customer->point +=  $this->point;
//        $this->customer->save();
//
//        Mail::send('email.birthday', $data, function ($message) use ($to_name, $to_email,$template) {
//            $message->to($to_email, $to_name)->subject($template->title);
//            $message->from('info@worldcarrental.com', 'World Car Rental');
//            $message->cc('worldrentalanya@gmail.com', 'World Car Rental');
//        });
//        if (count(Mail::failures()) == 0) {
//            $this->addError("Mail Gönderildi");
//        }else{
//            $this->addError(Mail::failures());
//        }


    }

//
//    public function handle()
//    {
//        $language = $this->language->find($this->customer->language);
//
//        $this->customer->point +=  $this->point;
//        $this->customer->save();
//
//        $mail = new BirthdaySendMail($this->customer,$language);
//        Mail::to($this->customer->email)->cc('worldrentalanya@gmail.com')->subject($language->subject_birthday)->send($mail);
//    }
}
