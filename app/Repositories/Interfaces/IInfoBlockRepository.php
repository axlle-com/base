<?php

namespace App\Repositories\Interfaces;

use App\Models\InfoBlock\InfoBlock;
use Illuminate\Pagination\LengthAwarePaginator;

interface IInfoBlockRepository extends IBaseRepository
{
    /**
     * @param array $filter
     * @param array $with
     * @return LengthAwarePaginator|InfoBlock[]
     */
    public function filter(array $filter = [], array $with = []);

    /**
     * @param InfoBlock $model
     * @param array $ids
     * @return void
     */
    public function syncGallery(InfoBlock $model, array $ids);
}
