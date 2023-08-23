<?php

namespace App\Services\Events;

use BeyondCode\LaravelWebSockets\WebSockets\Channels\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis;

class MatchDataUpdated implements ShouldBroadcast
{
    use SerializesModels;

    public $matchId;
    public $updatedData;

    public function __construct($matchId, $updatedData)
    {
        $this->matchId = $matchId;
        $this->updatedData = $updatedData;
    }

    public function broadcastOn(): Channel
    {
        return new Channel('match.'.$this->matchId);
    }
}
