<?php

namespace App\DTO\Casting;

use WendellAdriel\ValidatedDTO\Casting\Castable;
use WendellAdriel\ValidatedDTO\Exceptions\CastException;

class ExplodeCast implements Castable
{
    public function __construct(public string $delimiter = ',')
    {
    }

    /**
     * @throws CastException
     */
    public function cast(string $property, mixed $value): array
    {
        if (empty($value)) {
            return [];
        }

        if (is_string($value) && str_contains($value, $this->delimiter)) {
            return explode($this->delimiter, $value);
        }

        if (is_string($value)) {
            return [$value];
        }

        throw new CastException($property);
    }
}
