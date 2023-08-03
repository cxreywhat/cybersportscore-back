<?php

namespace App\Services;

use App\Interfaces\GameLogs;
use App\Models\GtMatch;
use App\Models\GtMatchGame;
use App\Models\GtMatchList;
use Illuminate\Support\Facades\DB;

class LolLogs implements GameLogs
{
    public function getLogs(GtMatchList $match, int $num): array
    {
        $logs = [];

        $logs[] = $this->matchStart($match->matchGames[$num-1]);

        foreach ($match->matchGames[$num-1]->match_data['events'] as $time => $event) {
            foreach ($event as $item) {
                $logs[] = $this->destroyedTower($item, $match->matchGames[$num-1], $time);
                $logs[] = $this->destroyedInhibitor($item, $match->matchGames[$num-1], $time);
                $logs[] = $this->killedBaronNashor($item, $match->matchGames[$num-1], $time);
                $logs[] = $this->killedAirDragon($item, $match->matchGames[$num-1], $time);
                $logs[] = $this->killedChemtechDragon($item, $match->matchGames[$num-1], $time);
                $logs[] = $this->killedEarthDragon($item, $match->matchGames[$num-1], $time);
                $logs[] = $this->killedFireDragon($item, $match->matchGames[$num-1], $time);
                $logs[] = $this->killedWaterDragon($item, $match->matchGames[$num-1], $time);

                $kills = $this->kills($item, $time);

                foreach ($kills as $kill) {
                    $logs[] = $kill;
                }
            }
        }

        $logs[] = $this->matchEnd($match->match, $num, $match->matchGames[$num-1]->duration);

        return array_filter($logs);
    }

    private function matchStart(GtMatchGame $game)
    {
        if ($game->db_id !== 0) {
            return [
                'event' =>'match-start',
                'time' => 0
            ];
        }
    }

    private function matchEnd(GtMatch $match, int $num, int $duration)
    {
        if ($num <= $match->t1s + $match->t2s) {
            return [
                'event' =>'match-end',
                'time' => $duration
            ];
        }
    }

    private function destroyedTower(array $event, GtMatchGame $game, int $time): ?array
    {
        if (array_key_exists('t1', $event) && $event['t1'] === 'tower_building') {
            return [
                'team' => $game->match_data['teams'][$event['s']]['title'],
                'event' => 'destroyed-tower',
                'time' => $time
            ];
        }

        return null;
    }

    private function destroyedInhibitor(array $event, GtMatchGame $game, int $time): ?array
    {
        if (array_key_exists('t1', $event) && $event['t1'] === 'inhibitor_building') {
            return [
                'team' => $game->match_data['teams'][$event['s']]['title'],
                'event' => 'destroyed-inhibitor',
                'time' => $time
            ];
        }

        return null;
    }

    private function killedBaronNashor(array $event, GtMatchGame $game, int $time): ?array
    {
        if (array_key_exists('t1', $event) && $event['t1'] === 'baron_nashor') {
            return [
                'team' => $game->match_data['teams'][$event['s']]['title'],
                'event' => 'baron-nashor',
                'time' => $time
            ];
        }

        return null;
    }

    private function killedFireDragon(array $event, GtMatchGame $game, int $time): ?array
    {
        if (array_key_exists('t1', $event) && $event['t1'] === 'fire_dragon') {
            return [
                'team' => $game->match_data['teams'][$event['s']]['title'],
                'event' => 'fire-dragon',
                'time' => $time
            ];
        }

        return null;
    }

    private function killedChemtechDragon(array $event, GtMatchGame $game, int $time): ?array
    {
        if (array_key_exists('t1', $event) && $event['t1'] === 'chemtech_dragon') {
            return [
                'team' => $game->match_data['teams'][$event['s']]['title'],
                'event' => 'chemtech-dragon',
                'time' => $time
            ];
        }

        return null;
    }

    private function killedEarthDragon(array $event, GtMatchGame $game, int $time): ?array
    {
        if (array_key_exists('t1', $event) && $event['t1'] === 'earth_dragon') {
            return [
                'team' => $game->match_data['teams'][$event['s']]['title'],
                'event' => 'earth-dragon',
                'time' => $time
            ];
        }

        return null;
    }

    private function killedAirDragon(array $event, GtMatchGame $game, int $time): ?array
    {
        if (array_key_exists('t1', $event) && $event['t1'] === 'air_dragon') {
            return [
                'team' => $game->match_data['teams'][$event['s']]['title'],
                'event' => 'air-dragon',
                'time' => $time
            ];
        }

        return null;
    }

    private function killedWaterDragon(array $event, GtMatchGame $game, int $time): ?array
    {
        if (array_key_exists('t1', $event) && $event['t1'] === 'water_dragon') {
            return [
                'team' => $game->match_data['teams'][$event['s']]['title'],
                'event' => 'water-dragon',
                'time' => $time
            ];
        }

        return null;
    }

    private function kills(array $event, int $time): ?array
    {
        $kills = [];

        if (array_key_exists('i', $event) && $event['i'] === '3') {
            foreach ($event['h'] as $h) {
                $team1Hero = DB::table('gt_hero_313')
                    ->when(is_int($h['t1']), function ($query) use ($h) {
                        $query->where('id', $h['t1']);
                    })
                    ->when(is_array($h['t1']), function ($query) use ($h) {
                        $query->whereIn('id', $h['t1']);
                    })
                    ->pluck('title')
                    ->toArray();

                $team2Hero = DB::table('gt_hero_313')
                    ->when(is_int($h['t2']), function ($query) use ($h) {
                        $query->where('id', $h['t2']);
                    })
                    ->when(is_array($h['t2']), function ($query) use ($h) {
                        $query->whereIn('id', $h['t2']);
                    })
                    ->pluck('title')
                    ->toArray();

                if ($h['s'] === 't1') {
                    $kills[] = [
                        'team1Left' => $team1Hero,
                        'team2Right' => $team2Hero,
                        'team1Side' => 'blue',
                        'event' => 'kill',
                        'time' => $time
                    ];
                }

                if ($h['s'] === 't2') {
                    $kills[] = [
                        'team1Left' => $team1Hero,
                        'team2Right' => $team2Hero,
                        'team1Side' => 'red',
                        'event' => 'kill',
                        'time' => $time
                    ];
                }
            }

            return $kills;
        }

        return [];
    }
}
