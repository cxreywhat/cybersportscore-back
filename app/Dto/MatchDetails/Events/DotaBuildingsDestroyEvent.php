<?php

declare(strict_types=1);

namespace App\Dto\MatchDetails\Events;

class DotaBuildingsDestroyEvent extends EventDto
{
    private array $buildings;

    public function getBuildings(): array
    {
        return $this->buildings;
    }

    public function setBuildings(array $buildings): void
    {
        $this->buildings = $buildings;
    }

    public function jsonSerialize(): array
    {
        return [
            'type' => 'dota_building_destroy',
            'duration' => $this->duration,
            'side' => $this->side,
            'buildings' => $this->buildings,
        ];
    }
}
