<?php

declare(strict_types=1);

namespace App\Dto\MatchDetails;

class MatchDto
{
    private bool $live;
    private ?string $winner = null;
    private int $gameId;
    private int $status;
    private int $bestOf;
    private ?int $liveNum;
    private int $num = 1;
    private ?TeamDto $team1 = null;
    private ?TeamDto $team2 = null;
    private int $duration = 0;
    private array $gold = [];
    private array $events = [];
    private array $stats = [];
    private ?AggregatedEventDto $aggregatedEvents = null;
    private TournamentDto $tournament;
    private bool $hasMatchData = false;
    private ?string $datetime;

    public function isHasMatchData(): bool
    {
        return $this->hasMatchData;
    }

    public function setHasMatchData(bool $hasMatchData): void
    {
        $this->hasMatchData = $hasMatchData;
    }

    public function getWinner(): ?string
    {
        return $this->winner;
    }

    public function setWinner(?string $winner): void
    {
        $this->winner = $winner;
    }

    public function getTournament(): TournamentDto
    {
        return $this->tournament;
    }

    public function setTournament(TournamentDto $tournament): void
    {
        $this->tournament = $tournament;
    }

    public function getStats(): array
    {
        return $this->stats;
    }

    public function setStats(array $stats): void
    {
        $this->stats = $stats;
    }

    public function getBestOf(): int
    {
        return $this->bestOf;
    }

    public function setBestOf(int $bestOf): void
    {
        $this->bestOf = $bestOf;
    }

    public function getGameId(): int
    {
        return $this->gameId;
    }

    public function setGameId(int $gameId): void
    {
        $this->gameId = $gameId;
    }

    public function isLive(): bool
    {
        return $this->status == 1;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function getLiveNum(): ?int
    {
        return $this->liveNum;
    }

    public function setLiveNum(?int $liveNum): void
    {
        $this->liveNum = $liveNum;
    }

    public function getAggregatedEvents(): ?AggregatedEventDto
    {
        return $this->aggregatedEvents;
    }

    public function setAggregatedEvents(AggregatedEventDto $events): void
    {
        $this->aggregatedEvents = $events;
    }

    public function getEvents(): array
    {
        return $this->events;
    }

    public function setEvents(array $events): void
    {
        $this->events = $events;
    }

    public function addEvent(EventDto $event): void
    {
        $this->events[] = $event;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): void
    {
        $this->duration = $duration;
    }

    public function getGold(): array
    {
        return $this->gold;
    }

    public function setGold(array $gold): void
    {
        $this->gold = $gold;
    }

    public function getNum(): int
    {
        return $this->num;
    }

    public function setNum(int $num): void
    {
        $this->num = $num;
    }

    public function getTeam1(): ?TeamDto
    {
        return $this->team1;
    }

    public function setTeam1(TeamDto $team1): void
    {
        $this->team1 = $team1;
    }

    public function getTeam2(): ?TeamDto
    {
        return $this->team2;
    }

    public function setTeam2(TeamDto $team2): void
    {
        $this->team2 = $team2;
    }

    public function isHasBans(): bool
    {
        return $this->team1->getBans() && $this->team2->getBans();
    }

    public function isHasPicks(): bool
    {
        return $this->team1->getPicks() && $this->team2->getPicks();
    }

    public function getMatchStart(): ?string
    {
        return $this->datetime;
    }

    public function setMatchStart(?string $datetime): void
    {
        $this->datetime = $datetime;
    }
}
