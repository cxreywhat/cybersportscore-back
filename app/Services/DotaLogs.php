<?php

namespace App\Services;

use App\Models\GtMatch;
use App\Models\GtMatchGame;
use App\Models\GtMatchList;
use App\Interfaces\GameLogs;
use Illuminate\Support\Facades\DB;

class DotaLogs implements GameLogs
{
    public function getLogs(GtMatchList $match, int $num): array
    {
        $logs = [];

        $logs[] = $this->matchStart($match->matchGames[$num-1]);

        foreach ($match->matchGames[$num - 1]->dotaEvents as $event) {
            foreach ($event['logs'] as $item) {
                $kills = $this->kills($item, $event['time']);
                $logs[] = $this->destroyedTower($item, $match->matchGames[$num - 1], $event['time']);
                $logs[] = $this->killedRoshan($item, $match->matchGames[$num - 1], $event['time']);
                foreach ($kills as $kill) {
                    $logs[] = $kill;
                }
                $logs[] = $this->pickedUpAegis($item, $event['time']);
            }
        }

        $logs[] = $this->matchEnd($match->match, $num, $match->matchGames[$num - 1]->duration);

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
        if (array_key_exists('b', $event)) {
            return [
                'team' => $game->match_data['teams'][$event['s']]['title'],
                'tower' => $event['b'][0],
                'event' => 'destroyed-tower',
                'time' => $time
            ];
        }

        return null;
    }

    private function pickedUpAegis(array $event, int $time): ?array
    {
        if (array_key_exists('a', $event) && !empty($event['a'])) {
            return [
                'hero' => $event['a']['h'],
                'event' => 'aegis',
                'time' => $time
            ];
        }

        return null;
    }

    private function killedRoshan(array $event, GtMatchGame $game, int $time): ?array
    {
        if (array_key_exists('r', $event)) {
            return [
                'team' => $event['r']['s'] ? $game->match_data['teams'][$event['r']['s']]['title'] : '',
                'event' => 'killed-roshan',
                'time' => $time
            ];
        }

        return null;
    }

    private function kills(array $event, int $time): array
    {
        if (array_key_exists('g1', $event) && array_key_exists('g2', $event)) {
            $kills = [];

            foreach ($event['h'] as $h) {
                $team1Hero = DB::table('gt_hero_582')
                    ->when(is_int($h['t1']), function ($query) use ($h) {
                        $query->where('id', $h['t1']);
                    })
                    ->when(is_array($h['t1']), function ($query) use ($h) {
                        $query->whereIn('id', $h['t1']);
                    })
                    ->pluck('title')
                    ->toArray();

                $team2Hero = DB::table('gt_hero_582')
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
                        'team1Left' => implode(', ', $team1Hero),
                        'team2Right' => implode(', ', $team2Hero),
                        'team1Side' => 'green',
                        'event' => 'kill',
                        'time' => $time
                    ];
                }

                if ($h['s'] === 't2') {
                    $kills[] = [
                        'team1Left' => implode(', ', $team1Hero),
                        'team2Right' => implode(', ', $team2Hero),
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
