<?php

enum MatchBroadcastType
{
    case LIVE;
    case PAST;

    public function broadcast(): string
    {
        return match ($this) {
            self::LIVE => 1,
            self::PAST => 2,
        };
    }
}
