<?php

namespace App\Repositories\Eloquent;

use App\Models\Post\Post;
use App\Models\Post\PostCategory;
use App\Repositories\Interfaces\IPostRepository;
use App\Services\Image\ImageServices;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class PostRepository.
 */
class PostRepository extends BaseRepository implements IPostRepository
{
    private ImageServices $imageServices;

    /**
     * PostRepository constructor.
     *
     * @param Post $model
     * @param ImageServices $imageServices
     */
    public function __construct(Post $model, ImageServices $imageServices)
    {
        $this->imageServices = $imageServices;
        parent::__construct($model);
    }

    /**
     * @return Collection|Post[]
     */
    public function get(): Collection
    {
        return $this->model::query()->created()->get();
    }

    /**
     * @param array $filter
     * @param array $with
     * @return LengthAwarePaginator|Post[]
     */
    public function filter(array $filter = [], array $with = []): LengthAwarePaginator
    {
        return $this->model::query()
            ->select([
                PostCategory::table('title') . ' as category_title',
                PostCategory::table('title_short') . ' as category_title_short',
            ])
            ->leftJoin(PostCategory::table(), PostCategory::table('id'), '=', $this->model::table('post_category_id'))
            ->created()
            ->paginate();
    }

    /**
     * @param array $attributes
     * @return Post
     */
    public function create(array $attributes): Post
    {
        return $this->model::create($attributes);
    }

    /**
     * @param string $alias
     * @param int|null $id
     * @return Post|null
     */
    public function existAlias(string $alias, ?int $id = null): ?Post
    {
        /** @var Post $model */
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
     * @return Post|null
     */
    public function existUrl(string $url, ?int $id = null): ?Post
    {
        /** @var Post $model */
        $model = $this->model::query()
            ->when($id, static function (Builder $builder) use ($id) {
                $builder->where('id', '!=', $id);
            })
            ->where('url', $url)
            ->first();

        return $model;
    }

    /**
     * @param Post $model
     * @param array $ids
     * @return void
     */
    public function syncGallery(Post $model, array $ids): void
    {
        $model->manyGallery()->sync($ids);
    }
}
