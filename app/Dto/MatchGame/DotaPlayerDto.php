<?php

declare(strict_types=1);

namespace App\Dto\MatchGame;

class DotaPlayerDto extends PlayerDto
{
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
