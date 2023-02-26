<?php namespace App\Repositories\Plate;

interface PlateRepositoryInterface
{

    public function get($id);

    public function all();

    public function delete($id);

    public function update(object $data);

    public function create(object $data);
}
