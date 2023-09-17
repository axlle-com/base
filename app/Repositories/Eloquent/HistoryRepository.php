<?php

namespace App\Repositories\Eloquent;

use App\Models\History\History;
use App\Repositories\Interfaces\IHistoryRepository;

class HistoryRepository extends BaseRepository implements IHistoryRepository
{
    /**
     * HistoryRepository constructor.
     *
     * @param History $model
     */
    public function __construct(History $model)
    {
        parent::__construct($model);
    }
}
