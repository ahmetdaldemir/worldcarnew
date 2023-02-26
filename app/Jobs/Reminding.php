<?php

namespace App\Jobs;

use App\Mail\RemindingSendMail;
use App\Models\Language;
use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class Reminding implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public $reservation;
    public $language;


    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
        $this->language = new Language();

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $language = $this->language->find($this->customer->language);
        $customer = Customer::find($this->reservation->id_customer);
        $mail = new RemindingSendMail($this->customer,$language);
        Mail::to($customer->email)->send($this->reservation);
    }
}
