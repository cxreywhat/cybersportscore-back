<?php

declare(strict_types=1);

namespace App\Dto\MatchDetails\Events;

class NashorKillEventDto extends EventDto
{
    private ?int $heroId = null;

    public function getHeroId(): ?int
    {
        return $this->heroId;
    }

    public function setHeroId(?int $heroId): void
    {
        $this->heroId = $heroId;
    }

    public function jsonSerialize(): array
    {
        return [
            'type' => 'nashor_kill',
            'duration' => $this->duration,
            'side' => $this->side,
            'hero_id' => $this->heroId,
        ];
    }

}
