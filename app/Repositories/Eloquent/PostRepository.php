<?php

namespace App\Repositories\Eloquent;

use App\Models\Post\Post;
use App\Models\Post\PostCategory;
use App\Models\Render;
use App\Repositories\Interfaces\IPostRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class PostRepository.
 */
class PostRepository extends BaseRepository implements IPostRepository
{
    /**
     * PostRepository constructor.
     *
     * @param Post $model
     */
    public function __construct(Post $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection|Post[]
     */
    public function all()
    {
        return $this->model::query()->created()->get();
    }

    /**
     * @param array $filter
     * @param array $with
     * @return LengthAwarePaginator|Post[]
     */
    public function filter(array $filter = [], array $with = [])
    {
        return $this->model::query()
            ->select([
                Render::table('title') . ' as render_title',
                PostCategory::table('title') . ' as category_title',
                PostCategory::table('title_short') . ' as category_title_short',
            ])
            ->leftJoin(Render::table(), Render::table('id'), '=', $this->model::table('render_id'))
            ->leftJoin(PostCategory::table(), PostCategory::table('id'), '=', $this->model::table('post_category_id'))
            ->created()
            ->paginate();
    }
}
