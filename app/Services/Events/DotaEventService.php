<?php

declare(strict_types=1);

namespace App\Services\Events;

use App\Dto\MatchDetails\AggregatedEventDto;
use App\Services\Events\Factories\DotaBuildingsDestroyEventFactory;
use App\Services\Events\Factories\FightFactory;
use App\Services\Events\Factories\RoshanEventFactory;
use Illuminate\Support\Str;

class DotaEventService extends EventService
{
    protected array $eventFactories = [
        self::EVENT_TYPE_HERO_KILL => FightFactory::class,
        self::EVENT_TYPE_BUILDING_DESTROY => DotaBuildingsDestroyEventFactory::class,
        self::EVENT_TYPE_ROSHAN_KILL => RoshanEventFactory::class
    ];

    private const EVENT_TYPE_HERO_KILL = 3;
    private const EVENT_TYPE_BUILDING_DESTROY = 2;
    private const EVENT_TYPE_ROSHAN_KILL = 1;

    public function handleEvents(array $data): array
    {
        $events = [];

        foreach ($data as $event) {
            $events[$event->time] = json_decode($event->logs, true);
        }

        return parent::handleEvents($events);
    }

    public function aggregateEvents(array $data): AggregatedEventDto
    {
        $dto = new AggregatedEventDto();

        $teamKills = [
            't1' => 0,
            't2' => 0,
        ];

        foreach ($data as $row) {
            $events = json_decode($row->logs, true);

            foreach ($events as $event) {
                if (!$dto->isFirstBlood()) {
                    if ($event['i'] == static::EVENT_TYPE_HERO_KILL) {
                        $dto->setFirstBlood($event['s']);
                    }
                }

                if ($event['i'] == static::EVENT_TYPE_BUILDING_DESTROY) {
                    if (!$dto->isFirstTowerDestroy()) {
                        $dto->setFirstTowerDestroy($event['s']);
                    }

                    if (array_key_exists('b', $event) && is_array($event['b'])) {
                        foreach ($event['b'] as $buildingName) {
                            $dto->addDestroyedBuilding(static::OPPONENTS[$event['s']] . '-' . Str::kebab($buildingName));
                        }
                    }
                }

                if (!$dto->isFirstEliteCreepKill()) {
                    if ($event['i'] == static::EVENT_TYPE_ROSHAN_KILL) {
                        $dto->setFirstEliteCreepKill($event['r']['s']);
                    }
                }

                if (!$dto->isFirst10Kills()) {
                    if ($event['i'] == static::EVENT_TYPE_HERO_KILL) {
                        if (array_key_exists('h', $event) && is_array($event['h'])) {
                            foreach ($event['h'] as $item) {
                                if ($item['s'] === 't1' || $item['s'] === 't2') { // skip denies by neutral creeps "t0"
                                    $teamKills[$item['s']] += is_array($item['t2']) ? count($item['t2']) : 1;
                                }
                            }

                            if ($teamKills['t1'] >= 10) {
                                $dto->setFirst10Kills('t1');
                            } elseif ($teamKills['t2'] >= 10) {
                                $dto->setFirst10Kills('t2');
                            }
                        }
                    }
                }
            }
        }

        return $dto;
    }

}
