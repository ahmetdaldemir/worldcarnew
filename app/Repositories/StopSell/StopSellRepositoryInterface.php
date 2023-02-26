<?php

namespace App\Repositories\StopSell;

interface StopSellRepositoryInterface
{

    public function get($id);

    public function all();

    public function delete($id);

    public function create(object $data);

    public function update($id, object $data);
}
