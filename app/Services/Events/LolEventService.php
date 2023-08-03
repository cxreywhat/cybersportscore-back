<?php

declare(strict_types=1);

namespace App\Services\Events;

use App\Dto\MatchDetails\AggregatedEventDto;
use App\Services\Events\Factories\BuildingNashorFactory;
use App\Services\Events\Factories\DragonNashorKillEventFactory;
use App\Services\Events\Factories\EventFactory;
use App\Services\Events\Factories\FightFactory;

class LolEventService extends EventService
{
    private const EVENT_TYPE_HERO_KILL = '3';
    private const EVENT_TYPE_BUILDING_DESTROY = '2';
    private const EVENT_TYPE_ELITE_CREEP_KILL = '2';
    private const EVENT_TYPE_DRAGON_KILL = '1';

    protected array $eventFactories = [
        self::EVENT_TYPE_HERO_KILL => FightFactory::class,
        self::EVENT_TYPE_BUILDING_DESTROY => BuildingNashorFactory::class,
        self::EVENT_TYPE_DRAGON_KILL => DragonNashorKillEventFactory::class
    ];

    public function aggregateEvents(array $data): AggregatedEventDto
    {
        $dto = new AggregatedEventDto();

        $teamKills = [
            't1' => 0,
            't2' => 0,
        ];

        foreach ($data as $duration => $events) {
            foreach ($events as $event) {
                if (!$dto->isFirstBlood()) {
                    if ($event['i'] == static::EVENT_TYPE_HERO_KILL) {
                        $dto->setFirstBlood($event['s']);
                    }
                }

                if (!$dto->isFirstTowerDestroy()) {
                    if (
                        $event['i'] == static::EVENT_TYPE_BUILDING_DESTROY
                        && array_key_exists('t1', $event)
                        && $event['t1'] === 'tower_building'
                    ) {
                        $dto->setFirstTowerDestroy($event['s']);
                    }
                }

                if (!$dto->isFirstEliteCreepKill()) {
                    if (
                        $event['i'] == static::EVENT_TYPE_ELITE_CREEP_KILL
                        && array_key_exists('t1', $event)
                        && $event['t1'] === 'baron_nashor'
                    ) {
                        $dto->setFirstEliteCreepKill($event['s']);
                    }
                }

                if (!$dto->isFirst10Kills()) {
                    if ($event['i'] == static::EVENT_TYPE_HERO_KILL) {
                        if (array_key_exists('h', $event) && is_array($event['h'])) {
                            foreach ($event['h'] as $item) {
                                $teamKills[$item['s']] += is_array($item['t1']) ? count($item['t1']) : 1;
                            }

                            if ($teamKills['t1'] >= 10) {
                                $dto->setFirst10Kills('t1');
                            } elseif ($teamKills['t2'] >= 10) {
                                $dto->setFirst10Kills('t2');
                            }
                        }
                    }
                }

                if ($dto->isFullFilled()) {
                    break;
                }
            }
        }

        return $dto;
    }
}
