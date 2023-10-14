<?php

namespace App\Repositories\Interfaces;

use App\Models\Page\Page;
use Illuminate\Pagination\LengthAwarePaginator;

interface IPageRepository extends IBaseRepository
{
    /**
     * @param string $alias
     * @param int|null $id
     * @return Page|null
     */
    public function existAlias(string $alias, ?int $id = null);

    /**
     * @param string $url
     * @param int|null $id
     * @return Page|null
     */
    public function existUrl(string $url, ?int $id = null);

    /**
     * @param Page $model
     * @param array $ids
     * @return void
     */
    public function syncGallery(Page $model, array $ids);

    /**
     * @param array $filter
     * @param array $with
     * @return LengthAwarePaginator|Page[]
     */
    public function filter(array $filter = [], array $with = []);
}
