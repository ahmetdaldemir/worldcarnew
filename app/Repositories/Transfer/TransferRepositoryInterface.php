<?php

namespace App\Repositories\Transfer;

interface TransferRepositoryInterface
{

    public function get($id);

    public function all();

    public function delete($id);

    public function find($id);

    public function update($id, object $data);

    public function create(object $data);
}
