<?php

namespace App\Repositories\Eloquent;

use App\Models\InfoBlock\InfoBlock;
use App\Repositories\Interfaces\IInfoBlockRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class InfoBlockRepository extends BaseRepository implements IInfoBlockRepository
{
    /**
     * InfoBlockRepository constructor.
     *
     * @param InfoBlock $model
     */
    public function __construct(InfoBlock $model)
    {
        parent::__construct($model);
    }

    /**
     * @param array $filter
     * @param array $with
     * @return LengthAwarePaginator|InfoBlock[]
     */
    public function filter(array $filter = [], array $with = []): LengthAwarePaginator
    {
        return $this->model::query()
            ->created()
            ->paginate();
    }

    /**
     * @param InfoBlock $model
     * @param array $ids
     * @return void
     */
    public function syncGallery(InfoBlock $model, array $ids): void
    {
        $model->manyGallery()->sync($ids);
    }
}
