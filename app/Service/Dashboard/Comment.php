<?php namespace App\Service\Dashboard;


class Comment
{
    public function handle()
    {
       return  \App\Models\Comment::where("status",0)->get()->take(10);
    }
}
