<?php namespace App\Service;

use App\Abstracts\ServiceRequest;
use App\Models\Customer;
use App\Models\ServiceConfig;
use App\Models\SmsTemplate;

class Sms extends ServiceRequest
{

    public function __construct(Customer $customer,SmsTemplate $smsTemplate)
    {

        
        parent::__construct($userConfig);
    }

}
