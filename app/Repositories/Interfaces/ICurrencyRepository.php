<?php

namespace App\Repositories\Interfaces;

interface ICurrencyRepository
{
    public function existOrCreate(array $attributes = []);

    public function getAllCode();

    public function getByCode(string $code);

    public function count();
}
