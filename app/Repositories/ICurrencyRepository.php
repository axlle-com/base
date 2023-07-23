<?php

namespace App\Repositories;

interface ICurrencyRepository
{
    public function existOrCreate(array $attributes = []);

    public function getAllCode();

    public function getByCode(string $code);

    public function count();
}
