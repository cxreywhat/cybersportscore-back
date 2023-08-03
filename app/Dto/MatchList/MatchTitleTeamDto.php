<?php

declare(strict_types=1);

namespace App\Dto\MatchList;

class MatchTitleTeamDto
{
    public function __construct(
        public readonly string $logo,
        public readonly int    $countryId,
        public readonly string $shortTitle,
    ) {
    }

    public function hasLogo(): bool
    {
        return !empty($this->logo);
    }
}
