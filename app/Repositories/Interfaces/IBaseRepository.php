<?php

namespace App\Repositories\Interfaces;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface IBaseRepository
 */
interface IBaseRepository
{
    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes);

    /**
     * @param int $id
     * @param array $with
     * @param array $params
     * @return Model|null
     */
    public function find(int $id, array $with = [], array $params = []);

    /**
     * @param int $id
     * @return Model|null
     */
    public function findWithTrash(int $id);

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id);

    /**
     * @param int $id
     * @param array $attributes
     * @return bool
     */
    public function update(int $id, array $attributes);

    /**
     * @param array $attributes
     * @param array $with
     * @return BaseModel|null
     */
    public function findByAttributes(array $attributes, array $with = []);

    /**
     * @return Collection|Model[]
     */
    public function get();
}
