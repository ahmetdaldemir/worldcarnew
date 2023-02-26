<?php namespace App\Service\Dashboard;


use App\Service\Care;

class Notification
{

    public function handle()
    {
        $service_care = new Care();
        $service_care->start();
    }

}
