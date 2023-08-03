<?php

declare(strict_types=1);

namespace App\Dto\MatchDetails;

class TeamDto
{
    private bool $hasLogo;

    private int $matchScore;

    /**
     * @param int $id
     * @param string $title
     * @param int $score
     * @param string $shortTitle
     * @param array<PlayerDto> $players
     * @param array $bans
     * @param array $picks
     * @param string $goldAdvantage
     * @param string $expAdvantage
     */
    public function __construct(
        public readonly int $id,
        private string $title = '',
        private readonly int $score = 0,
        private string $shortTitle = '',
        private array $players = [],
        private array $bans = [],
        private array $picks = [],
        private int $goldAdvantage = 0,
        private int $expAdvantage = 0
    ) {
    }

    public function getMatchScore(): int
    {
        return $this->matchScore;
    }

    public function setMatchScore(int $matchScore): void
    {
        $this->matchScore = $matchScore;
    }

    public function getBans(): array
    {
        return $this->bans;
    }

    public function setBans(array $bans): void
    {
        $this->bans = $bans;
    }

    public function getPicks(): array
    {
        return $this->picks;
    }

    public function setPicks(array $picks): void
    {
        $this->picks = $picks;
    }

    public function hasPlayers(): bool
    {
        return !empty($this->players);
    }

    public function getPlayers(): array
    {
        return $this->players;
    }

    public function setPlayers(array $players): void
    {
        $this->players = $players;
    }

    public function isHasLogo(): bool
    {
        return $this->hasLogo;
    }

    public function setHasLogo(bool $hasLogo): void
    {
        $this->hasLogo = $hasLogo;
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function hasShortTitle(): bool
    {
        return !empty($this->shortTitle);
    }

    public function hasTitle(): bool
    {
        return !empty($this->title);
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getShortTitle(): string
    {
        return $this->shortTitle;
    }

    public function setShortTitle(string $shortTitle): void
    {
        $this->shortTitle = $shortTitle;
    }

    public function getGoldAdvantage(): int
    {
        return $this->goldAdvantage;
    }

    public function setGoldAdvantage(int $goldAdvantage): void
    {
        $this->goldAdvantage = $goldAdvantage;
    }

    public function getExpAdvantage(): int
    {
        return $this->expAdvantage;
    }

    public function setExpAdvantage(int $expAdvantage): void
    {
        $this->expAdvantage = $expAdvantage;
    }

}
