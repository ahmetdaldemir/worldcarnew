<?php


namespace App\Repositories\Log;


interface LogRepositoryInterface
{
    public function get($id);

    public function all();

    public function delete($id);

    public function update(object $data);

    public function create(array $data);
}
