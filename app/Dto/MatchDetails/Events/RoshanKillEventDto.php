<?php

declare(strict_types=1);

namespace App\Dto\MatchDetails\Events;

class RoshanKillEventDto extends EventDto
{
    private ?string $pickedUpSide = null;
    private ?string $pickedUpHero = null;

    public function getPickedUpSide(): ?string
    {
        return $this->pickedUpSide;
    }

    public function setPickedUpSide(?string $pickedUpSide): void
    {
        $this->pickedUpSide = $pickedUpSide;
    }

    public function getPickedUpHero(): ?string
    {
        return $this->pickedUpHero;
    }

    public function setPickedUpHero(?string $pickedUpHero): void
    {
        $this->pickedUpHero = $pickedUpHero;
    }

    public function jsonSerialize(): array
    {
        return [
            'type' => 'roshan_kill',
            'duration' => $this->duration,
            'side' => $this->side,
            'pick_up_aegis_side' => $this->pickedUpSide,
            'pick_up_aegis_hero' => $this->pickedUpHero
        ];
    }

}
