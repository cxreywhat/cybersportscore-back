<?php

declare(strict_types=1);

namespace App\Dto\MatchDetails\Events;

class GroupKillEventDto extends EventDto
{
    private array $killers;
    private array $victims;

    public function getKillers(): array
    {
        return $this->killers;
    }

    public function setKillers(array $killers): void
    {
        $this->killers = $killers;
    }

    public function getVictims(): array
    {
        return $this->victims;
    }

    public function setVictims(array $victims): void
    {
        $this->victims = $victims;
    }

    public function jsonSerialize(): array
    {
        return [
            'type' => 'group_kill',
            'duration' => $this->duration,
            'side' => $this->side,
            'killers' => $this->killers,
            'victims' => $this->victims,
        ];
    }
}
