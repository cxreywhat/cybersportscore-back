<?php

declare(strict_types=1);

namespace App\Services\Events\Factories;

use App\Dto\MatchDetails\Events\DragonKillDto;
use App\Dto\MatchDetails\Events\EventDto;
use App\Dto\MatchDetails\Events\NashorKillEventDto;

class DragonNashorKillEventFactory implements EventFactory
{
    public function build(array $data, int $duration): EventDto
    {
        // sometimes i = 1 contains nashor kill event
        if ($data['t1'] === 'baron_nashor') {
            $event = new NashorKillEventDto($duration, $data['s']);
        } else {
            $event = new DragonKillDto($duration, $data['s']);
            $event->setCategory($data['t1']);
        }

        if (!empty($data['h']) && is_numeric($data['h'])) {
            $event->setHeroId((int) $data['h']);
        }

        return $event;
    }
}
