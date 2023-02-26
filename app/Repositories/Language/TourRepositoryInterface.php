<?php

namespace App\Repositories\Language;

interface TourRepositoryInterface
{

    public function get($id);

    public function all();

    public function delete($id);

    public function find($id);

    public function update($id, object $data);

    public function create(object $data);
}
