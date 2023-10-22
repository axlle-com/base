<?php

namespace App\Repositories\Eloquent;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Collection;

abstract class BaseRepository
{
    /**
     * @var BaseModel
     */
    protected $model;

    /**
     * BaseRepository constructor.
     */
    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * @return Collection|BaseModel[]
     */
    public function get()
    {
        return $this->model::get();
    }

    /**
     * @param array $attributes
     * @return BaseModel
     */
    public function create(array $attributes): BaseModel
    {
        return $this->model::create($attributes);
    }

    /**
     * @param int $id
     * @param array $with
     * @param array $params
     * @return BaseModel|null
     */
    public function find(int $id, array $with = [], array $params = []): ?BaseModel
    {
        /** @var BaseModel $model */
        $model = $this->model::query()->with($with)->find($id);

        return $model;
    }

    /**
     * @param int $id
     * @return BaseModel|null
     */
    public function findWithTrash(int $id): ?BaseModel
    {
        return $this->model::query()->withTrashed()->find($id);
    }

    /**
     * @param int $id
     * @return bool|mixed|null
     */
    public function delete(int $id)
    {
        return $this->model::query()->find($id)?->delete();
    }

    /**
     * @param int $id
     * @param array $attributes
     * @return BaseModel
     */
    public function update(int $id, array $attributes): BaseModel
    {
        /** @var BaseModel $model */
        $model = $this->find($id)?->fill($attributes);
        $model->save();

        return $model;
    }

    /**
     * @param array $attributes
     * @param array $with
     * @return BaseModel|null
     */
    public function findByAttributes(array $attributes, array $with = []): ?BaseModel
    {
        $query = $this->model::query()->with($with);
        foreach ($attributes as $key => $value) {
            $query = $query->where($key, $value);
        }

        return $query->first();
    }
}
