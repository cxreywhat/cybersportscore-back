<?php

declare(strict_types=1);

namespace App\Dto\MatchGame;

class LolPlayerDto extends PlayerDto
{
    private int $neutralLastHits = 0;
    private int $buildingsDamage = 0;
    private int $wardsPlaced = 0;
    private int $wardsDestroyed = 0;

    public function getNeutralLastHits(): int
    {
        return $this->neutralLastHits;
    }

    public function setNeutralLastHits(int $neutralLastHits): LolPlayerDto
    {
        $this->neutralLastHits = $neutralLastHits;

        return $this;
    }

    public function getBuildingsDamage(): int
    {
        return $this->buildingsDamage;
    }

    public function setBuildingsDamage(int $buildingsDamage): LolPlayerDto
    {
        $this->buildingsDamage = $buildingsDamage;

        return $this;
    }

    public function getWardsPlaced(): int
    {
        return $this->wardsPlaced;
    }

    public function setWardsPlaced(int $wardsPlaced): LolPlayerDto
    {
        $this->wardsPlaced = $wardsPlaced;

        return $this;
    }

    public function getWardsDestroyed(): int
    {
        return $this->wardsDestroyed;
    }

    public function setWardsDestroyed(int $wardsDestroyed): LolPlayerDto
    {
        $this->wardsDestroyed = $wardsDestroyed;

        return $this;
    }

    public static function fromArray(array $data): static
    {
        return parent::fromArray($data)
            ->setKills($data['k'])
            ->setDeaths($data['d'])
            ->setAssists($data['a'])
            ->setDamage($data['dmg'])
            ->setDamageTaken($data['tdmg'])
            ->setHeal($data['heal'])
            ->setLastHits($data['l'])
            ->setNeutralLastHits($data['ln'])
            ->setBuildingsDamage($data['tdmg'])
            ->setWardsPlaced($data['wp'])
            ->setWardsDestroyed($data['wd']);
    }
}
