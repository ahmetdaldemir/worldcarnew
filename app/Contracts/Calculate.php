<?php namespace App\Contracts;


interface Calculate
{
    public function  upLocationResponse(object $data);
    public function  dropLocationResponse(object $data);
    public function  up_time(string $data);
    public function  down_time(string $data);
    public function  up_date(string $data);
    public function  down_date(string $data);
    public function  up_location(int $data);
    public function  drop_location(int $data);
    public function  length(int $data);
    public function  period(string $data);
    public function  upPrice(string $data);
    public function  dropPrice(string $data);
    public function  cars(array $data);
}
