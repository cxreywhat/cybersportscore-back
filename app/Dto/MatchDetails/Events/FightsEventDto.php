<?php

declare(strict_types=1);

namespace App\Dto\MatchDetails\Events;

// side - can be "t0"
class FightsEventDto extends EventDto
{
    private ?int $team1Gold = null;
    private ?int $team1Damage = null;

    private ?int $team2Gold = null;
    private ?int $team2Damage = null;

    /**
     * @var array<KillEventDto|GroupKillEventDto>
     */
    private array $fights = [];

    public function getTeam1Gold(): ?int
    {
        return $this->team1Gold;
    }

    public function setTeamsDamage(?int $team1Damage, ?int $team2Damage): void
    {
        $this->team1Damage = $team1Damage;
        $this->team2Damage = $team2Damage;
    }

    public function setTeamsGold(?int $team1Gold, ?int $team2Gold): void
    {
        $this->team1Gold = $team1Gold;
        $this->team2Gold = $team2Gold;
    }

    public function getTeam1Damage(): ?int
    {
        return $this->team1Damage;
    }

    public function getTeam2Gold(): ?int
    {
        return $this->team2Gold;
    }

    public function getTeam2Damage(): ?int
    {
        return $this->team2Damage;
    }

    public function getFights(): array
    {
        return $this->fights;
    }

    public function addFight(KillEventDto|GroupKillEventDto $fight): void
    {
        $this->fights[] = $fight;
    }

    public function setFights(array $fights): void
    {
        $this->fights = $fights;
    }

    public function jsonSerialize(): array
    {
        return [
            'type' => 'fights',
            'duration' => $this->duration,
            'side' => $this->side,
            'team1_gold' => $this->team1Gold,
            'team2_gold' => $this->team2Gold,
            'team1_damage' => $this->team1Damage,
            'team2_damage' => $this->team2Damage,
            'fights' => $this->fights,
        ];
    }
}
