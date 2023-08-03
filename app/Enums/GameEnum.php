<?php

namespace App\Enums;

use BackedEnum;

enum GameEnum: int
{
    case PUBG = 100;
    case VALORANT = 200;
    case FORTNITE = 300;
    case LOL = 313;
    case DOTA2 = 582;
    case RAINBOW_SIX = 600;
    case CSGO = 704;
    case HEARTHSTONE = 800;
    case OVERWATCH = 755;

    public function eng(): string {
        return self::getEng($this);
    }

    public function title(): string {
        return self::getTitle($this);
    }

    public static function getEng(self $value): string {
        return match ($value) {
            self::PUBG => 'pubg',
            self::VALORANT => 'valorant',
            self::FORTNITE => 'fortnite',
            self::LOL => 'lol',
            self::DOTA2 => 'dota-2',
            self::RAINBOW_SIX => 'r6',
            self::CSGO => 'csgo',
            self::HEARTHSTONE => 'hearthstone',
            self::OVERWATCH => 'overwatch',
        };
    }

    public static function getTitle(self $value): string {
        return match ($value) {
            self::PUBG => 'PUBG',
            self::VALORANT => 'Valorant',
            self::FORTNITE => 'Fortnite',
            self::LOL => 'LoL',
            self::DOTA2 => 'Dota 2',
            self::RAINBOW_SIX => 'Rainbow Six',
            self::CSGO => 'CS:GO',
            self::HEARTHSTONE => 'Hearthstone',
            self::OVERWATCH => 'Overwatch',
        };
    }

    public static function tryFromEng(string $name): ?self
    {
        return match ($name) {
            'pubg' => self::PUBG,
            'valorant' => self::VALORANT,
            'fortnite' => self::FORTNITE,
            'lol' => self::LOL,
            'dota-2' => self::DOTA2,
            'r6' => self::RAINBOW_SIX,
            'csgo' => self::CSGO,
            'hearthstone' => self::HEARTHSTONE,
            'overwatch' => self::OVERWATCH,
            default => null
        };
    }

    public static function fromEng(string $name): self
    {
        return match ($name) {
            'pubg' => self::PUBG,
            'valorant' => self::VALORANT,
            'fortnite' => self::FORTNITE,
            'lol' => self::LOL,
            'dota-2' => self::DOTA2,
            'r6' => self::RAINBOW_SIX,
            'csgo' => self::CSGO,
            'hearthstone' => self::HEARTHSTONE,
            'overwatch' => self::OVERWATCH,
        };
    }
}
