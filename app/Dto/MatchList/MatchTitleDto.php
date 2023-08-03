<?php

declare(strict_types=1);

namespace App\Dto\MatchList;

class MatchTitleDto
{
    public function __construct(
        public readonly string            $tournamentTitle,
        public readonly string            $tournamentMemberType,
        public readonly bool              $live,
        public readonly string            $tournamentIcon,
        public readonly string            $nameCached,
        public readonly int               $tournamentCountryId,
        public readonly MatchTitleTeamDto $team1,
        public readonly MatchTitleTeamDto $team2,
    ) {
    }

    public static function fromJson(string $title): static
    {
        $tokens = explode('/', $title);

        return new static(
            $tokens[0],
            $tokens[1],
            $tokens[2] === '1',
            $tokens[3],
            $tokens[4],
            (int) $tokens[5],
            new MatchTitleTeamDto($tokens[6], (int) $tokens[7], $tokens[8] ?: 'TBD'),
            new MatchTitleTeamDto($tokens[9], (int) $tokens[10], $tokens[11] ?: 'TBD'),
        );
    }
}
