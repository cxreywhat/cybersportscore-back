<?php

declare(strict_types=1);

namespace App\Services\Events\Factories;

use App\Dto\MatchDetails\Events\EventDto;
use App\Dto\MatchDetails\Events\BuildingDestroyEventDto;
use App\Dto\MatchDetails\Events\NashorKillEventDto;

class BuildingNashorFactory implements EventFactory
{
    public function build(array $data, int $duration): EventDto
    {
        if ($data['t1'] !== 'baron_nashor') {
            $event = new BuildingDestroyEventDto($duration, $data['s']);
            $event->setCategory($data['t1']);

            if (!empty($data['t2'])) {
                $event->setSubCategory($data['t2']);
            }

            if (!empty($data['h'])) {
                $event->setHeroId($data['h']);
            }

        } else {
            $event = new NashorKillEventDto($duration, $data['s']);

            if (!empty($data['h']) && is_numeric($data['h'])) {
                $event->setHeroId((int) $data['h']);
            }
        }

        return $event;
    }
}
