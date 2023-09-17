<?php

namespace App\Repositories\Eloquent;

use App\Models\Ip;
use App\Repositories\Interfaces\IIpRepository;

class IpRepository extends BaseRepository implements IIpRepository
{
    /**
     * IpRepository constructor.
     *
     * @param Ip $model
     */
    public function __construct(Ip $model)
    {
        parent::__construct($model);
    }

    /**
     * @param array $attributes
     * @return Ip|null
     */
    public function existOrCreate(array $attributes = []): ?Ip
    {
        /** @var Ip $model */
        $model = $this->model::query()
            ->where('ip', $attributes['ip'])
            ->first();
        if ($model) {
            return $model;
        }

        return $this->model::create($attributes);
    }
}
