<?php

declare(strict_types=1);

namespace App\Dto\MatchGame;

class PickBanDto implements \JsonSerializable
{
    public function __construct(
        public readonly int $heroId,
        public readonly string $heroTitle,
        public readonly int $order = 0,
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'hero_id' => $this->heroId,
            'hero_title' => $this->heroTitle,
            'order' => $this->order,
        ];
    }
}
