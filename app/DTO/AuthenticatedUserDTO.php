<?php

namespace App\DTO;

final class AuthenticatedUserDTO
{
    public function __construct(
        public readonly int $id,
        public readonly int $profileId,
        public readonly string $name,
        public readonly string $email,
        public readonly string $apiToken,
        public readonly string $startRoute,
        public readonly bool $isPartner,
    ) {
    }
}
