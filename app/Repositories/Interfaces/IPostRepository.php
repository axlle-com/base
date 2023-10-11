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

    /**
     * @param string $alias
     * @param int|null $id
     * @return Post|null
     */
    public function existAlias(string $alias, ?int $id = null);

    /**
     * @param string $url
     * @param int|null $id
     * @return Post|null
     */
    public function existUrl(string $url, ?int $id = null);

    /**
     * @param Post $model
     * @param array $ids
     * @return void
     */
    public function syncGallery(Post $model, array$ids);
}
