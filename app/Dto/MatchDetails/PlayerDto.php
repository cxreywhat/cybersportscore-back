<?php

declare(strict_types=1);

namespace App\Dto\MatchDetails;

use App\Dto\Match\PlayerDto as MatchPlayerDto;
use App\Dto\MatchGame\PlayerDto as MatchGamePlayerDto;

class PlayerDto
{
    public function __construct(
        public readonly MatchPlayerDto $matchPlayer,
        public readonly MatchGamePlayerDto $matchGamePlayer,
    ) {
    }
}
