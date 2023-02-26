<?php

namespace App\Http\Controllers\Admin;

class CommandConsoleController extends \App\Http\Controllers\Controller
{

    public function currencyupdate()
    {
        \Artisan::call('cron:currency');
       return redirect()->back();
    }

}
