<?php

namespace App\Repositories\Interfaces;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface IBaseRepository
 */
interface IBaseRepository
{
    public function create(array $attributes): Model;

    public function find(int $id, array $with = [], array $params = []): ?Model;

    public function findWithTrash(int $id): ?Model;

    public function delete(int $id);

    public function update(int $id, array $attributes): bool;

    /**
     * @param array $attributes
     * @param array $with
     * @return BaseModel|null
     */
    public function findByAttributes(array $attributes, array $with = []);
}
