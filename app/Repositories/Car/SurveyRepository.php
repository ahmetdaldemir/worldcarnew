<?php

namespace App\Repositories\Car;

use App\Models\Car;

class CarRepository implements CarRepositoryInterface
{

    public function get($id)
    {
        // TODO: Implement get() method.
    }

    public function all()
    {
        $Car = Car::all();
        return $Car;
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
