<?php

namespace App\Repositories\Eloquent;

use App\Models\Page\Page;
use App\Models\Post\PostCategory;
use App\Models\Render;
use App\Repositories\Interfaces\IPostCategoryRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class PostCategoryRepository.
 */
class PostCategoryRepository extends BaseRepository implements IPostCategoryRepository
{
    /**
     * PostCategoryRepository constructor.
     *
     * @param PostCategory $model
     */
    public function __construct(PostCategory $model)
    {
        parent::__construct($model);
    }

    /**
     * @param array $filter
     * @param array $with
     * @return LengthAwarePaginator|PostCategory[]
     */
    public function filter(array $filter = [], array $with = []): LengthAwarePaginator
    {
        return $this->model::query()
            ->select([
                Render::table('title') . ' as render_title',
                'pc.title as category_title',
                'pc.title_short as category_title_short',
            ])
            ->leftJoin(Render::table(), Render::table('id'), '=', $this->model::table('render_id'))
            ->leftJoin(PostCategory::table() . ' as pc', 'pc.id', '=', $this->model::table('post_category_id'))
            ->created()
            ->paginate();
    }

    /**
     * @param string $alias
     * @param int|null $id
     * @return PostCategory|null
     */
    public function existAlias(string $alias, ?int $id = null): ?PostCategory
    {
        /** @var PostCategory $model */
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
     * @return PostCategory|null
     */
    public function existUrl(string $url, ?int $id = null): ?PostCategory
    {
        /** @var PostCategory|null $model */
        $model = $this->model::query()
            ->when($id, static function (Builder $builder) use ($id) {
                $builder->where('id', '!=', $id);
            })
            ->where('url', $url)
            ->first();

        return $model;
    }

    /**
     * @param PostCategory $model
     * @param array $ids
     * @return void
     */
    public function syncGallery(PostCategory $model, array $ids): void
    {
        $model->manyGallery()->sync($ids);
    }
}
