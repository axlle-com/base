<?php

namespace App\Repositories\Eloquent;

use App\Models\Gallery\Gallery;
use App\Repositories\Interfaces\IGalleryRepository;

/**
 * Class GalleryRepository.
 */
class GalleryRepository extends BaseRepository implements IGalleryRepository
{
    /**
     * GalleryRepository constructor.
     *
     * @param Gallery $model
     */
    public function __construct(Gallery $model)
    {
        parent::__construct($model);
    }

    /**
     * @param int $id
     * @return Gallery|null
     */
    public function existById(int $id): ?Gallery
    {
        /** @var Gallery $model */
        $model = $this->model::query()->find($id);

        return $model;
    }
}
