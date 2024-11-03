<?php

declare(strict_types=1);

namespace App\Component\User;

use Symfony\Component\Serializer\Annotation\Groups;

class FullNameDto
{
    public function __construct(
        #[Groups(['user:read', 'user:write'])]
        private string $givenName,

        #[Groups(['user:read', 'user:write'])]
        private string $familyName,

        #[Groups(['user:read', 'user:write'])]
        private bool $isMarried)
    {
    }

    public function getGivenName(): string
    {
        return $this->givenName;
    }

    public function getFamilyName(): string
    {
        return $this->familyName;
    }

    public function isMarried(): bool
    {
        return $this->isMarried;
    }
}