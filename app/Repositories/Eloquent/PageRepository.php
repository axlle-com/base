<?php

namespace App\Repositories\Eloquent;

use App\Models\Page\Page;
use App\Repositories\Interfaces\IPageRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class PageRepository.
 */
class PageRepository extends BaseRepository implements IPageRepository
{
    /**
     * PageRepository constructor.
     *
     * @param Page $model
     */
    public function __construct(Page $model)
    {
        parent::__construct($model);
    }

    /**
     * @param string $alias
     * @param int|null $id
     * @return Page|null
     */
    public function existAlias(string $alias, ?int $id = null): ?Page
    {
        /** @var Page|null $model */
        $model = $this->model::query()
            ->when($id, static function (Builder $builder) use ($id) {
                $builder->where('id', '!=', $id);
            })
            ->where('alias', $alias)
            ->first();

        return $model;
    }

    /**
     * @param string $url
     * @param int|null $id
     * @return Page|null
     */
    public function existUrl(string $url, ?int $id = null): ?Page
    {
        /** @var Page|null $model */
        $model = $this->model::query()
            ->when($id, static function (Builder $builder) use ($id) {
                $builder->where('id', '!=', $id);
            })
            ->where('url', $url)
            ->first();

        return $model;
    }

    /**
     * @param Page $model
     * @param array $ids
     * @return void
     */
    public function syncGallery(Page $model, array $ids): void
    {
        $model->manyGallery()->sync($ids);
    }

    /**
     * @param array $filter
     * @param array $with
     * @return LengthAwarePaginator|Page[]
     */
    public function filter(array $filter = [], array $with = []): LengthAwarePaginator
    {
        return $this->model::query()
            ->created()
            ->paginate();
    }
}
