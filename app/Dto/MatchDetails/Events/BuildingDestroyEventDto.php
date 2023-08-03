<?php

declare(strict_types=1);

namespace App\Dto\MatchDetails\Events;

class BuildingDestroyEventDto extends EventDto
{
    private string $category;
    private ?string $subCategory = null;
    private ?int $heroId = null;

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

    public function getSubCategory(): ?string
    {
        return $this->subCategory;
    }

    public function setSubCategory(?string $subCategory): void
    {
        $this->subCategory = $subCategory;
    }

    public function jsonSerialize(): array
    {
        return [
            'type' => 'building_destroy',
            'duration' => $this->duration,
            'side' => $this->side,
            'category' => $this->category,
            'sub_category' => $this->subCategory,
            'hero_id' => $this->heroId,
        ];
    }

}
