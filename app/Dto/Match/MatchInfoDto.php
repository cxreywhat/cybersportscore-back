<?php

declare(strict_types=1);

namespace App\Dto\Match;

class MatchInfoDto implements \JsonSerializable
{
    // TODO: move constant to the config or the service
    public const AVAILABLE_BETS = ['bb'];

    public function __construct(
        public readonly TeamDto $team1,
        public readonly TeamDto $team2,
        public readonly array $bets,
    ) {
    }

    public function jsonSerialize(): mixed
    {
        return [
            'teams' => [
                $this->team1,
                $this->team2,
            ],
            'bets' => $this->bets
        ];
    }

    public static function fromJson(string $json, int $team1Id = null, int $team2Id = null, string $matchId = null): ?static
    {
        if ($data = json_decode($json, true)) {

            if ($team1Id && $team2Id) {
                $bets = static::createOrderedBets($data, $team1Id, $team2Id, $matchId);
            } else {
                $bets = static::createBets($data, $matchId);
            }

            return new static(
                static::createTeam($data['t1']),
                static::createTeam($data['t2']),
                $bets
            );
        }

        return null;
    }

    /**
     * @param array $data
     * @return array<BetDto>
     */
    private static function createBets(array $data, string $matchId = null): array
    {
        $bets = [];

        foreach (static::AVAILABLE_BETS as $name) {
            if (array_key_exists($name, $data) && is_array($data[$name]) && $matchId) {
                $arrayBets = array_values($data[$name]);

                $bets[] = new BetDto(
                    $name,
                    $arrayBets[0],
                    $arrayBets[1],
                    $matchId
                );
            }
        }

        return $bets;
    }

    /**
     * @param array $data
     * @param int $team1Id
     * @param int $team2Id
     * @return array<BetDto>
     */
    private static function createOrderedBets(array $data, int $team1Id, int $team2Id, string $matchId = null): array
    {
        $bets = [];

        foreach (static::AVAILABLE_BETS as $name) {
            if (
                array_key_exists($name, $data)
                && $matchId
                && !empty($data[$name][$team1Id])
                && !empty($data[$name][$team2Id])
            ) {
                $bets[] = new BetDto(
                    $name,
                    $data[$name][$team1Id],
                    $data[$name][$team2Id],
                    $matchId
                );
            }
        }

        return $bets;
    }


    private static function createPlayer(array $player): PlayerDto
    {
        return new PlayerDto(
            $player['id'],
            $player['cid'],
            $player['role'],
            $player['nick'],
        );
    }

    private static function createTeam(array $team): TeamDto
    {
        return new TeamDto(
            ($team['n'] ?? ''),
            ($team['t'] ?? ''),
            ($team['l'] ?? ''),
            array_map(
                fn(array $player) => static::createPlayer($player),
                ($team['players'] ?? [])
            ),
        );
    }
}
