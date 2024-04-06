<?php

namespace App\Repositories\Eloquent;

use App\Models\InfoBlock\InfoBlockHasResource;
use App\Repositories\Interfaces\IInfoBlockHasResourceRepository;

class InfoBlockHasResourceRepository extends BaseRepository implements IInfoBlockHasResourceRepository
{
    /**
     * InfoBlockHasResourceRepository constructor.
     *
     * @param InfoBlockHasResource $model
     */
    public function __construct(InfoBlockHasResource $model)
    {
        parent::__construct($model);
    }
}
