<?php namespace App\Repositories\AccountingCategory;

interface AccountingCategoryRepositoryInterface
{

    public function get($id);

    public function all();

    public function delete($id);

    public function update($id, object $data);

    public function create(object $data);
}
