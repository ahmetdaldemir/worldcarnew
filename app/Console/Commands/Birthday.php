<?php

namespace App\Console\Commands;

use App\Models\Customer;
use App\Models\EmailTemplate;
use App\Models\Language;
use App\Traits\HasErrors;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class Birthday extends Command
{

    use Dispatchable, HasErrors;

    protected $signature = 'birthday:cron';

    protected $description = 'Doğum Günü Mail Ve Mesajları Yönetimi';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $customers = Customer::where('birthday', 'LIKE', '%' . Carbon::now()->format('-m-d'));
        $i = 0;
        foreach ($customers->get() as $item) {
            $this->point = 1000;
            $user_language = $item->language;
            $template = EmailTemplate::where('language_id', $user_language)->where('email_template_id', 5)->first();
            $data['user_language_id'] = $user_language;
            $data['template'] = $template;
            $data['fullname'] = $item->fullname;
            $to_name = $item->fullname;
            $to_email =  $item->email;
            $item->point += $this->point;
            $item->save();
            $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';

            if (!is_null($to_email)) {
                if (filter_var($to_email, FILTER_VALIDATE_EMAIL)) {
                    Mail::send('email.birthday', $data, function ($message) use ($to_name, $to_email, $template) {
                        $message->to($to_email, $to_name)->subject($template->title);
                        $message->from('info@worldcarrental.com', 'World Car Rental');
                        $message->cc('worldrentalanya@gmail.com', 'World Car Rental');
                    });
                }

            }
        }
    }
}
