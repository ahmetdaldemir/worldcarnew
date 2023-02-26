<?php


namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class Repository
{
    public Model $model;

    /**
     * Repository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param $id
     * @return Collection|null
     */
    public function get($id):?Collection
    {
        return $this->model->get($id);
    }

    /**
     *
     */
    public function all():?Collection
    {
        $this->model->all();
    }


    /**
     * @param $id
     * @return bool
     */
    public function delete($id):bool
    {
        return $this->model->delete($id);
    }

    public function find($id)
    {

    }

    public function update($id, object $data)
    {

    }

    public function create(object $data)
    {

    }
}
