<?php

declare(strict_types=1);

namespace App\Dto\MatchDetails;

class TournamentDto
{
    public function __construct(
        public readonly int $id,
        public readonly string $eng,
        public readonly string $title,
        public readonly string $icon,
        public readonly int $prize,
    ) {
    }

    public function hasIcon(): bool
    {
        return !empty($this->icon);
    }
}
