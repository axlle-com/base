<?php

namespace App\Repositories\Interfaces;

use App\Models\Post\Post;
use Illuminate\Database\Eloquent\Collection;

interface IPostRepository extends IBaseRepository
{
    /**
     * @param array $filter
     * @param array $with
     * @return Collection|Post[]
     */
    public function filter(array $filter = [], array $with = []);
}
