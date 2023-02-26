<?php


namespace App\Contracts;


use App\Models\ServiceConfig;

interface Service
{
    public function getUserConfig(): ServiceConfig;

}
