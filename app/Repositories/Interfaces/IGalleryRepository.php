<?php

namespace App\Repositories\Interfaces;

use App\Models\Gallery\Gallery;

interface IGalleryRepository extends IBaseRepository
{
    /**
     * @param int $id
     * @return Gallery|null
     */
    public function existById(int $id);
}
