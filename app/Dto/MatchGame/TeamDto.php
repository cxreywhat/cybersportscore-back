<?php

declare(strict_types=1);

namespace App\Dto\MatchGame;

class TeamDto
{
    /**
     * @param array<PlayerDto> $players
     */
    public function __construct(
        public readonly int $id,
        public readonly string $title,
        public readonly int $score = 0,
        public readonly int $goldAdvantage = 0,
        public readonly array $players = [],
        public readonly array $picks = [],
        public readonly array $bans = [],
        public readonly bool $winner = false,
    ) {
    }

    public function isHasBans(): bool
    {
        return !empty($this->bans);
    }

    public function isHasPicks(): bool
    {
        return !empty($this->picks);
    }

    public function getExperience(int $duration): int
    {
        if ($duration) {
            return (int) array_sum(
                array_map(fn(PlayerDto $player) => $player->xpm * floor($duration / 60), $this->players)
            );
        }

        return 0;
    }
}
