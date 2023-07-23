<?php

namespace App\DTO;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class ErrorDTO extends ValidatedDTO
{
    public string $message;

    public function attributes(): array
    {
        return [
            'message' => 'Сообщение',
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
            'message' => 'required|string',
        ];
    }
}
