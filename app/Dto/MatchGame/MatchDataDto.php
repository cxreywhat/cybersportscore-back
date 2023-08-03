<?php

declare(strict_types=1);

namespace App\Dto\MatchGame;

use App\Enums\GameEnum;

class MatchDataDto
{
    public function __construct(
        public readonly int     $duration,
        public readonly TeamDto $team1,
        public readonly TeamDto $team2,
        public readonly array $gold = [],
        public readonly array $events = [],
    ) {
    }

    public function getTeam1ExperienceAdvantage(): int
    {
        return max($this->team1->getExperience($this->duration) - $this->team2->getExperience($this->duration), 0);
    }

    public function getTeam2ExperienceAdvantage(): int
    {
        return max($this->team2->getExperience($this->duration) - $this->team1->getExperience($this->duration), 0);
    }

//    public static function createEmpty()

    public static function fromJson(?string $json, ?GameEnum $game = null): ?static
    {
        if ($json) {
            return static::fromArray(json_decode($json, true), $game);
        }

        return null;
    }

    public static function fromArray(?array $data, ?GameEnum $game = null): ?static
    {
        if ($data === null) {
            return null;
        }

        /** @var PlayerDto|string $className */
        $className = match ($game) {
            GameEnum::LOL => LolPlayerDto::class,
            GameEnum::DOTA2 => DotaPlayerDto::class,
            default => PlayerDto::class,
        };

        $team1Gold = 0;
        $team2Gold = 0;

        if (!empty($data['gold'])) {
            $seconds = array_keys($data['gold']);

            $gold = array_map(
                fn($value, $second) => [
                    'time' => $second,
                    'diff' => $value
                ],
                $data['gold'],
                $seconds
            );

            if (count($seconds) > 1 && $seconds[0] > $seconds[1]) {
                $gold[] = array_shift($gold);
            }

            $lastGold = $gold[count($gold) - 1]['diff'];

            if ($lastGold > 0) {
                $team1Gold = $lastGold;
            } else {
                $team2Gold = abs($lastGold);
            }
        }

        return new static(
            (int) $data['duration'],
            static::createTeam($data['teams']['t1'], $team1Gold, $className),
            static::createTeam($data['teams']['t2'], $team2Gold, $className),
            ($gold ?? []),
            ($data['events'] ?? []),
        );
    }

    private static function createTeam(array $team, int $gold, $className): TeamDto
    {
        return new TeamDto(
            (int) $team['tid'],
            (string) $team['title'],
            (int) $team['score'],
            $gold,
            array_map(
                fn(array $player) => $className::fromArray($player),
                $team['players']
            ),
            static::createPickOrBan($team['picks'] ?? []),
            static::createPickOrBan($team['bans'] ?? []),
            (bool) $team['win'],
        );
    }

    private static function createPickOrBan(array $items): array
    {
        return array_map(
            fn(array $pick) => new PickBanDto(
                $pick['id'],
                $pick['title'],
                $pick['order'] ?? 0,
            ),
            $items
        );
    }
}
