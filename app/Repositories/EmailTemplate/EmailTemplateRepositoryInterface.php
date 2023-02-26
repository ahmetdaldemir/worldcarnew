<?php

namespace App\Repositories\EmailTemplate;

interface EmailTemplateRepositoryInterface
{

    public function get($id);

    public function all();

    public function delete($id);

    public function find($id);

    public function update($id, object $data);

    public function create(object $data);
}
