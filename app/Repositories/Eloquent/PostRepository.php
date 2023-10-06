<?php

namespace App\Repositories\Eloquent;

use App\Models\Post\Post;
use App\Repositories\Interfaces\IPostRepository;

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
}
