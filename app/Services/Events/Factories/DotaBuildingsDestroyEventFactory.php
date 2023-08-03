<?php

declare(strict_types=1);

namespace App\Services\Events\Factories;

use App\Dto\MatchDetails\Events\DotaBuildingsDestroyEvent;
use App\Dto\MatchDetails\Events\EventDto;

class DotaBuildingsDestroyEventFactory implements EventFactory
{
    public function build(array $data, int $duration): EventDto
    {
        $event = new DotaBuildingsDestroyEvent($duration, $data['s']);
        $event->setBuildings($data['b']);

        return $event;
    }

}
