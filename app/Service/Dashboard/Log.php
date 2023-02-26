<?php


namespace App\Service\Dashboard;


use  \DB;

class Log
{

    public function handle()
    {
       return DB::table('laravel_logger_activity')->orderBy('id', 'desc')->get()->take(10);
    }
}
