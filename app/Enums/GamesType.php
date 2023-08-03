<?php

namespace App\Enums;

enum GamesType
{
    case DOTA2;
    case LOL;
    case CSGO;
    case HEARTHSTONE;
    case OVERWATCH;

    public function broadcast(): string
    {
        return match ($this) {
            self::DOTA2 => '582',
            self::LOL => '313',
            self::CSGO => '704',
            self::OVERWATCH => '800',
            self::HEARTHSTONE => '755',
        };
    }
}
