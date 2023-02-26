<?php

namespace App\Repositories\Car;

use App\Models\Car;
use App\Models\Language;
use Redis;

class CarRepository implements CarRepositoryInterface
{

    public function get($id)
    {
        // TODO: Implement get() method.
    }

    public function all()
    {
        $redis = new Redis();
        $redis->connect('localhost', 6379);
        $langId = Language::where("url", app()->getLocale())->first()->id;
        $Car = Car::all();
        $redis->set('car_' . $langId, json_encode($Car));
        return $Car;

        if (!$redis->get('car_' . $langId)) {
            $Car = Car::all();
            $redis->set('car_' . $langId, json_encode($Car));
            return $Car;
        } else {
            return json_decode($redis->get('car_' . $langId));
        }
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function update(object $data)
    {
        // TODO: Implement update() method.
    }

    public function create(object $data)
    {
        // TODO: Implement create() method.
    }
}
