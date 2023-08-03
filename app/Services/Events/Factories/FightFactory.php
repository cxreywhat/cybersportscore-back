<?php

declare(strict_types=1);

namespace App\Services\Events\Factories;

use App\Dto\MatchDetails\Events\EventDto;
use App\Dto\MatchDetails\Events\FightsEventDto;
use App\Dto\MatchDetails\Events\GroupKillEventDto;
use App\Dto\MatchDetails\Events\KillEventDto;

// mid 311103 id 466144 "t0" killer
class FightFactory implements EventFactory
{
    protected const OPPONENTS = ['t1' => 't2', 't2' => 't1'];

    public function build(array $data, int $duration): EventDto
    {
        $event = new FightsEventDto($duration, $data['s']);

        if (array_key_exists('g1', $data) && array_key_exists('g2', $data)) {
            $event->setTeamsGold($data['g1'], $data['g2']);
        }

        if (array_key_exists('d1', $data) && array_key_exists('d2', $data)) {
            $event->setTeamsDamage($data['d1'], $data['d2']);
        }

        foreach ($data['h'] as $fight) {

            if (is_array($fight['t1'])) {
                if (count($fight['t1']) === 1 && count($fight['t2']) == 1) {
                    $subEvent = new KillEventDto($fight['t'], $fight['s']);
                    $subEvent->setKiller((int) $fight['t1'][0]);
                    $subEvent->setVictim((int) $fight['t2'][0]);
                } else {
                    $subEvent = new GroupKillEventDto($fight['t'], $fight['s']);
                    $subEvent->setKillers($fight['t1']);
                    $subEvent->setVictims($fight['t2']);
                }

            } else {
                $subEvent = new KillEventDto($fight['t'], $fight['s']);
                $subEvent->setKiller((int) $fight['t1']);
                $subEvent->setVictim((int) $fight['t2']);
            }

            $event->addFight($subEvent);
        }

        return $event;
    }
}
