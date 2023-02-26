<?php

namespace App\Console\Commands;

use App\Models\Country;
use App\Models\Customer;
use Illuminate\Console\Command;

class PhoneEdit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'phone:edit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
       $customers = Customer::all();
       foreach ($customers as $customer)
       {
          $country = Country::where("country_code",$customer->nationality)->first();
           if(strstr($customer->phone,"00".$country->country_code)){
               $customerphone =  str_replace("00".$country->country_code, " ", $customer->phone);
               $customer->phone = $customerphone;
               $customer->phone_country = "+".$country->country_code;
               $customer->save();
           }
       }
    }
}
