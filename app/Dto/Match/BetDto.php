<?php

declare(strict_types=1);

namespace App\Dto\Match;

class BetDto implements \JsonSerializable
{
    public function __construct(
        public readonly string $name,
        public readonly int|float $team1Rate,
        public readonly int|float $team2Rate,
        public readonly ?string $matchId,
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
            'rates' => [
                $this->team1Rate,
                $this->team2Rate,
            ],
            'url' => 'go?to=' . $this->name . '&k1&m=' . $this->matchId,
            'icon_url' => '/media/odds/small/' . $this->name . '.png',
        ];
    }
}
