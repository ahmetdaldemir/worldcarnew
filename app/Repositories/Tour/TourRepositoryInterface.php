<?php

namespace App\Repositories\Tour;

interface TourRepositoryInterface
{

    public function get($id);

    public function all();

    public function delete($id);

    public function find($id);

    public function update(object $data);

    public function create(object $data);
}
