<?php

declare(strict_types=1);

namespace App\Services\Events\Factories;

use App\Dto\MatchDetails\Events\EventDto;
use App\Dto\MatchDetails\Events\RoshanKillEventDto;

class RoshanEventFactory implements EventFactory
{
    public function build(array $data, int $duration): EventDto
    {
        $event = new RoshanKillEventDto($duration, $data['r']['s']);

        if (array_key_exists('a', $data)) {
            if (array_key_exists('c', $data['a'])) {
                $event->setPickedUpSide($data['a']['c'] ?? null);
            } else {
                $event->setPickedUpSide($data['a']['s'] ?? null);
            }

            $event->setPickedUpHero($data['a']['h'] ?? null);
        }

        return $event;
    }
}
