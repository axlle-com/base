<?php

namespace App\Repositories\Interfaces;

use App\Models\Ip;

interface IIpRepository extends IBaseRepository
{
    /**
     * @param array $attributes
     * @return Ip|null
     */
    public function existOrCreate(array $attributes = []): ?Ip;
}
