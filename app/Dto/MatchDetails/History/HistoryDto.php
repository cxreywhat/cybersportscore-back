<?php

declare(strict_types=1);

namespace App\Dto\MatchDetails\History;

use App\Dto\MatchList\MatchTitleDto;
use Illuminate\Support\Collection;

class HistoryDto
{
    public function __construct(
        public readonly int $team1Id,
        public readonly int $team2Id,
        public readonly MatchTitleDto $matchTitle,
        public readonly Collection $team1Block,
        public readonly Collection $team2Block,
        public readonly Collection $commonBlock,
    ) {
    }
}
