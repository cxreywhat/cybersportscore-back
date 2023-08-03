<?php

declare(strict_types=1);

namespace App\Dto\MatchDetails\Events;

class DragonKillDto extends EventDto
{
    private ?int $heroId = null;
    private string $category;

    public function getHeroId(): ?int
    {
        return $this->heroId;
    }

    public function setHeroId(?int $heroId): void
    {
        $this->heroId = $heroId;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    public function jsonSerialize(): array
    {
        return [
            'type' => 'dragon_kill',
            'duration' => $this->duration,
            'side' => $this->side,
            'hero_id' => $this->heroId,
            'category' => $this->category,
        ];
    }
}
