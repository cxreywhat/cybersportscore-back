<?php

namespace App\Services;

use App\Interfaces\GameEvents;

class DotaEvents implements GameEvents {
    public function firstDestroyedTower(array $events): ?string
    {
        if ($events) {
            foreach ($events as $event) {
                foreach ($event as $item) {
                    if (array_key_exists('b', $item)) {
                        return $item['s'];
                    }
                }
            }
        }

        return null;
    }

    public function firstKilledEliteCreep(array $events): ?string
    {
        if ($events) {
            foreach ($events as $event) {
                foreach ($event as $item) {
                    if (array_key_exists('r', $item)) {
                        return $item['r']['s'];
                    }
                }
            }
        }

        return null;
    }

    public function firstTenKills(array $events): ?string
    {
        $killsTeam1 = 0;
        $killsTeam2 = 0;

        if ($events) {
            foreach ($events as $event) {
                foreach ($event as $item) {
                    if (array_key_exists('s', $item)) {
                        if ($item['s'] === 't1') {
                            $killsTeam1++;
                        }

                        if ($item['s'] === 't2') {
                            $killsTeam2++;
                        }
                    }
                }


                if ($killsTeam1 >= 10) {
                    return 't1';
                }

                if ($killsTeam2 >= 10) {
                    return 't2';
                }
            }
        }

        return null;
    }

    public function firstBlood(array $events): ?string
    {
        if ($events) {
            foreach ($events as $event) {
                foreach ($event as $item) {
                    if (array_key_exists('h', $item) && is_array($item['h'])) {
                        return $item['h'][0]['s'];
                    }
                }
            }
        }

        return null;
    }
}
