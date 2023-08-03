<?php

declare(strict_types=1);

namespace App\Dto\MatchGame;

class PlayerDto
{
    protected int $kills = 0;
    protected int $deaths = 0;
    protected int $assists = 0;
    protected int $lastHits = 0;
    protected int $damage = 0;
    protected int $damageTaken = 0;
    protected int $heal = 0;

    public function __construct(
        public readonly int $id,
        public readonly string $nick,
        public readonly int $heroId = 0,
        public readonly int $level = 0,
        public readonly int $gpm = 0,
        public readonly int $xpm = 0,
        public readonly int $netWorth = 0, // goldEarned
        public readonly ?string $side = null,
        public readonly ?string $heroTitle = null,
        public readonly array $items = [],
    ) {
    }

    public static function fromArray(array $data): static
    {
        return new static(
            (int) $data['id'],
            $data['nick'],
            (int) $data['hero_id'],
            (int) $data['lvl'],
            (int) $data['gpm'],
            (int) ($data['xpm'] ?? 0),
            (int) $data['n'],
            ($data['side'] ?? null),
            $data['hero_title'],
            $data['items'],
        );
    }

    public function getKills(): int
    {
        return $this->kills;
    }

    public function setKills(int $kills): PlayerDto
    {
        $this->kills = $kills;

        return $this;
    }

    public function getDeaths(): int
    {
        return $this->deaths;
    }

    public function setDeaths(int $deaths): PlayerDto
    {
        $this->deaths = $deaths;

        return $this;
    }

    public function getAssists(): int
    {
        return $this->assists;
    }

    public function setAssists(int $assists): PlayerDto
    {
        $this->assists = $assists;

        return $this;
    }

    public function getLastHits(): int
    {
        return $this->lastHits;
    }

    public function setLastHits(int $lastHits): PlayerDto
    {
        $this->lastHits = $lastHits;

        return $this;
    }

    public function getDamage(): int
    {
        return $this->damage;
    }

    public function setDamage(int $damage): PlayerDto
    {
        $this->damage = $damage;

        return $this;
    }

    public function getDamageTaken(): int
    {
        return $this->damageTaken;
    }

    public function setDamageTaken(int $damageTaken): PlayerDto
    {
        $this->damageTaken = $damageTaken;

        return $this;
    }

    public function getHeal(): int
    {
        return $this->heal;
    }

    public function setHeal(int $heal): PlayerDto
    {
        $this->heal = $heal;

        return $this;
    }
}
