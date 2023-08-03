<?php

declare(strict_types=1);

namespace App\Dto\MatchDetails\History;

class HistoryBlockItemDto
{
    private array $teams = [];
    private string $date;
    private string $logo;
    private int $bestOf;
    private int $matchId;
    private int $tournamentId;
    private string $tournamentTitle;

    public function __construct(
        private ?int $priorityTeam = null
    ) {
    }

    public function getTeams(): array
    {
        return $this->teams;
    }

    public function setTeams(TeamDto $team1, TeamDto $team2): void
    {
        if ($this->priorityTeam) {
            if ($team1->id === $this->priorityTeam) {
                $this->teams = [$team1, $team2];
            } elseif ($team2->id === $this->priorityTeam) {
                $this->teams = [$team2, $team1];
            } else {
                throw new \Exception('No teams compatible with priority team');
            }

            return;
        }

        $this->teams = [$team1, $team2];
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    public function getLogo(): string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): void
    {
        $this->logo = $logo;
    }

    public function hasLogo(): bool
    {
        return !empty($this->logo);
    }

    public function getBestOf(): int
    {
        return $this->bestOf;
    }

    public function setBestOf(int $bestOf): void
    {
        $this->bestOf = $bestOf;
    }

    public function getMatchId(): int
    {
        return $this->matchId;
    }

    public function setMatchId(int $matchId): void
    {
        $this->matchId = $matchId;
    }

    public function getTournamentId(): int
    {
        return $this->tournamentId;
    }

    public function setTournamentId(int $tournamentId): void
    {
        $this->tournamentId = $tournamentId;
    }

    public function getTournamentTitle(): string
    {
        return $this->tournamentTitle;
    }

    public function setTournamentTitle(string $tournamentTitle): void
    {
        $this->tournamentTitle = $tournamentTitle;
    }

}
