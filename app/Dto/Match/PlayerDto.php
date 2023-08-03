<?php

declare(strict_types=1);

namespace App\Dto\Match;

class PlayerDto
{
    public function __construct(
        public readonly int $id,
        public readonly int $countryId = 0,
        public readonly int $role = 0,
        public readonly string $nick = '',
    ) {
    }
}
