<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface ICurrencyExchangeRateRepository extends IBaseRepository
{
    /**
     * @param array $attributes
     * @return mixed
     */
    public function existOrCreate(array $attributes = []);

    /**
     * @param array $attributes
     * @return Collection|null
     */
    public function getOneByPeriod(array $attributes = []);

    /**
     * @param int $date
     * @return int
     */
    public function countByDay(int $date);
}
