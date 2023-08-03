<?php

declare(strict_types=1);

namespace App\Dto\MatchDetails\Events;

abstract class EventDto implements \JsonSerializable
{
    public function __construct(
        public readonly int $duration,
        public readonly string $side,
    ) {
    }
}
