<?php

declare(strict_types=1);

namespace App\Dto\MatchGame;

class DotaPlayerDto extends PlayerDto
{
    protected int $denies = 0;

    public function getDenies(): int
    {
        return $this->denies;
    }

    public function setDenies(int $denies): DotaPlayerDto
    {
        $this->denies = $denies;

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
            ->setDenies($data['dn']);
    }
}
