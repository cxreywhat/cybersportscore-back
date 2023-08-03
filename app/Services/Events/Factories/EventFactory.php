<?php

declare(strict_types=1);

namespace App\Services\Events\Factories;

use App\Dto\MatchDetails\Events\EventDto;

interface EventFactory
{
    public function build(array $data, int $duration): EventDto;
}
