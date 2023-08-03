<?php

declare(strict_types=1);

namespace App\Dto\MatchDetails\Events;

class KillEventDto extends EventDto
{
    private int $killer;
    private int $victim;

    public function getKiller(): int
    {
        return $this->killer;
    }

    public function setKiller(int $killer): void
    {
        $this->killer = $killer;
    }

    public function getVictim(): int
    {
        return $this->victim;
    }

    public function setVictim(int $victim): void
    {
        $this->victim = $victim;
    }

    public function jsonSerialize(): array
    {
        return [
            'type' => 'kill',
            'duration' => $this->duration,
            'side' => $this->side,
            'killer' => $this->killer,
            'victim' => $this->victim,
        ];
    }
}
