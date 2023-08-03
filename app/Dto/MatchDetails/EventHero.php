<?php

declare(strict_types=1);

namespace App\Dto\MatchDetails;

class EventHero
{
    public function __construct(
        public readonly string $side,
        public readonly array $team1heroes,
        public readonly array $team2heroes,
        public readonly int $duration,
    ) {
    }
}
