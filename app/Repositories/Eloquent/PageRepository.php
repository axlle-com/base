<?php

namespace App\Repositories\Eloquent;

use App\Models\Page\Page;
use App\Repositories\Interfaces\IPageRepository;

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
}
