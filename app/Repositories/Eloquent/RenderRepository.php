<?php

namespace App\Repositories\Eloquent;

use App\Models\Render;
use App\Repositories\Interfaces\IRenderRepository;

/**
 * Class PostCategoryRepository.
 */
class RenderRepository extends BaseRepository implements IRenderRepository
{
    /**
     * RenderRepositoryRepository constructor.
     *
     * @param Render $model
     */
    public function __construct(Render $model)
    {
        parent::__construct($model);
    }
}
