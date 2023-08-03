<?php

declare(strict_types=1);

namespace App\Dto\MatchDetails\History;

class TeamDto
{
    public function __construct(
        public readonly int $id,
        public readonly int $score,
        public readonly string $title,
        public readonly string $shortTitle,
        public readonly bool $hasLogo,
    ) {
    }
}
