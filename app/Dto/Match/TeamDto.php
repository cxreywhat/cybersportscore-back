<?php

declare(strict_types=1);

namespace App\Dto\Match;

class TeamDto implements \JsonSerializable
{
    /**
     * @param array<PlayerDto> $players
     */
    public function __construct(
        public readonly string $name,
        public readonly string $shortName,
        public readonly string $logo,
        public readonly array $players,
    ) {
    }

    public function hasLogo(): bool
    {
        return !empty($this->logo);
    }

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
            'short_name' => $this->shortName,
            'logo' => $this->logo,
            'players' => $this->players,
        ];
    }
}
