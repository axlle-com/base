<?php

namespace App\Repositories\Eloquent;

use App\Models\Gallery\GalleryImage;
use App\Repositories\Interfaces\IGalleryImageRepository;

/**
 * Class GalleryImageRepository.
 */
class GalleryImageRepository extends BaseRepository implements IGalleryImageRepository
{
    /**
     * GalleryImageRepository constructor.
     *
     * @param GalleryImage $model
     */
    public function __construct(GalleryImage $model)
    {
        parent::__construct($model);
    }

    /**
     * @param int $id
     * @return GalleryImage|null
     */
    public function existById(int $id): ?GalleryImage
    {
        /** @var GalleryImage $model */
        $model = $this->model::query()->find($id);

        return $model;
    }
}
