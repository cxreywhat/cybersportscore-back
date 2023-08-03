<?php

declare(strict_types=1);

namespace App\Dto\MatchDetails;

class AggregatedEventDto implements \JsonSerializable
{
    public function __construct(
        private ?string $firstBlood = null,
        private ?string $first10Kills = null,
        private ?string $firstTowerDestroy = null,
        private ?string $firstEliteCreepKill = null,
        private array $destroyedBuildings = [],
    ) {
    }

    public function isFullFilled(): bool
    {
        return $this->firstBlood
            && $this->first10Kills
            && $this->firstTowerDestroy
            && $this->firstEliteCreepKill;
    }

    public function getDestroyedBuildings(): array
    {
        return $this->destroyedBuildings;
    }

    public function setDestroyedBuildings(array $value): void
    {
        $this->destroyedBuildings = $value;
    }

    public function addDestroyedBuilding(string $value): void
    {
        $this->destroyedBuildings[] = $value;
    }

    public function isFirstBlood(): bool
    {
        return $this->firstBlood !== null;
    }

    public function setFirstBlood(string $team): void
    {
        $this->firstBlood = $team;
    }

    public function isFirst10Kills(): bool
    {
        return $this->first10Kills !== null;
    }

    public function setFirst10Kills(string $team): void
    {
        $this->first10Kills = $team;
    }

    public function isFirstTowerDestroy(): bool
    {
        return $this->firstTowerDestroy !== null;
    }

    public function setFirstTowerDestroy(string $team): void
    {
        $this->firstTowerDestroy = $team;
    }

    public function isFirstEliteCreepKill(): bool
    {
        return $this->firstEliteCreepKill !== null;
    }

    public function setFirstEliteCreepKill(string $team): void
    {
        $this->firstEliteCreepKill = $team;
    }

    public function jsonSerialize(): array
    {
        return [
            'first_blood' => $this->firstBlood,
            'first_10_kills' => $this->first10Kills,
            'first_tower' => $this->firstTowerDestroy,
            'first_elite_creep_kill' => $this->firstEliteCreepKill,
            'destroyed_buildings' => $this->destroyedBuildings
        ];
    }
}
