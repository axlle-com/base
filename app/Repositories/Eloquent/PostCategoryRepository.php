<?php

namespace App\Repositories\Eloquent;

use App\Models\Post\PostCategory;
use App\Repositories\Interfaces\IPostCategoryRepository;

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
}
