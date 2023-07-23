<?php

namespace App\DTO;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class CurrencyFiltersDTO extends ValidatedDTO
{
    public ?string $date;
    public ?string $currency;

    /**
     * @return string[]
     */
    public function attributes(): array
    {
        return [
            'date' => 'Дата курса',
            'currency' => 'Код валюты',
        ];
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'date' => 'nullable|string',
            'currency' => 'required|string',
        ];
    }

    /**
     * @return array
     */
    protected function defaults(): array
    {
        return [
            'date' => date('Y-m-d'),
        ];
    }

    /**
     * @return array
     */
    protected function casts(): array
    {
        return [];
    }
}
