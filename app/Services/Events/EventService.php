<?php

declare(strict_types=1);

namespace App\Services\Events;

use App\Dto\MatchDetails\AggregatedEventDto;
use App\Enums\GameEnum;
use App\Services\Events\Factories\EventFactory;

abstract class EventService
{
    protected const OPPONENTS = ['t1' => 't2', 't2' => 't1'];

    protected array $eventFactories = [];

    abstract public function aggregateEvents(array $data): AggregatedEventDto;

    public function handleEvents(array $data): array
    {
        $instances = [];

        foreach ($data as $duration => $events) {
            foreach ($events as $event) {
                /** @var EventFactory|string $factory */
                if ($factory = ($this->eventFactories[$event['i']] ?? null)) {
                    $instances[] = (new $factory())->build($event, (int) $duration);
                }
            }
        }

        return $instances;
    }

    public static function discipline(GameEnum|int $game): self
    {
        if (is_int($game)) {
            $game = GameEnum::from($game);
        }

        return match ($game) {
            GameEnum::LOL => new LolEventService(),
            GameEnum::DOTA2 => new DotaEventService(),
            default => throw new \Exception('To be implemented'),
        };
    }
}
