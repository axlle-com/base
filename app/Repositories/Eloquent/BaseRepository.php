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
     * @return Collection
     */
    public function all()
    {
        return $this->model::get();
    }

    public function create(array $attributes): BaseModel
    {
        return $this->model::create($attributes);
    }

    public function find(int $id, array $with = [], array $params = []): ?BaseModel
    {
        /** @var BaseModel $model */
        $model = $this->model::query()->with($with)->first($id);

        return $model;
    }

    public function findWithTrash(int $id): ?BaseModel
    {
        return $this->model::query()->withTrashed()->find($id);
    }

    public function delete(int $id)
    {
        return $this->model::query()->find($id)?->delete();
    }

    public function update(int $id, array $attributes): bool
    {
        $model = $this->find($id);

        return $model && $model->update($attributes);
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
