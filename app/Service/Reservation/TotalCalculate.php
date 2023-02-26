<?php


namespace App\Service\Reservation;


use App\Models\Reservation;

class TotalCalculate
{

    protected $array;

    public function __construct($array)
    {
        $this->array = $array;
    }

    public function handle()
    {
        $data = [];
        $data['days'] = 0;
        $data['price']['tl'] = 0;
        $data['price']['usd'] = 0;
        $data['price']['eur'] = 0;
        $data['price']['gbp'] = 0;


        foreach ($this->array as $item) {
            if (gettype($item) != 'object') {
                $item = (object)$item;
            }

            $data['days'] += $item->days;
            if ($item->id_currency == 1) {
                $data['price']['tl'] += $item->total_amount;
            }

            if ($item->id_currency == 2) {
                $data['price']['eur'] += $item->total_amount;
            }

            if ($item->id_currency == 3) {
                $data['price']['usd'] += $item->total_amount;
            }

            if ($item->id_currency == 4) {
                $data['price']['gbp'] += $item->total_amount;
            }

        }
        return $data;
    }

}
