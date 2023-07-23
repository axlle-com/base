<?php

namespace App\DTO;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class UserFiltersDTO extends ValidatedDTO
{
    public ?string $name;

    public function attributes(): array
    {
        return [
            'name' => 'ФИО',
        ];
    }

    public function casts(): array
    {
        return [];
    }

    public function defaults(): array
    {
        return [];
    }

    public function messages(): array
    {
        return [];
    }

    public function rules(): array
    {
        return [
            'name' => 'nullable|string',
        ];
    }
}
