<?php


namespace App\Service\Dashboard;


class Transfer
{
    public function handle()
    {
        return \App\Models\Transfer::where('status','waiting')->get();
    }
}
