<?php

namespace App\Repositories\Interfaces;

use App\Models\Gallery\GalleryImage;

interface IGalleryImageRepository extends IBaseRepository
{
    /**
     * @param int $id
     * @return GalleryImage|null
     */
    public function existById(int $id);
}
