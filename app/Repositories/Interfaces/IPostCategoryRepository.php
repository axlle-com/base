<?php

namespace App\Repositories\Interfaces;

use App\Models\Post\Post;
use App\Models\Post\PostCategory;
use Illuminate\Pagination\LengthAwarePaginator;

interface IPostCategoryRepository extends IBaseRepository
{
    /**
     * @param array $filter
     * @param array $with
     * @return LengthAwarePaginator|Post[]
     */
    public function filter(array $filter = [], array $with = []);

    /**
     * @param string $alias
     * @param int|null $id
     * @return PostCategory|null
     */
    public function existAlias(string $alias, ?int $id = null);

    /**
     * @param PostCategory $model
     * @param array $ids
     * @return void
     */
    public function syncGallery(PostCategory $model, array$ids);
}
