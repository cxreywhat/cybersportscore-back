<?php

namespace App\Http\Resources\MatchDetails;

use App\Dto\MatchDetails\MatchDto;
use App\Enums\GameEnum;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin MatchDto
 */
class MatchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'is_live' => $this->isLive(),
            'winner' => $this->getWinner(),
            'datetime' => strtotime($this->getMatchStart()),
            'has_match_data' => $this->isHasMatchData(),
            'num_live' => $this->getLiveNum(),
            'game_id' => $this->getGameId(),
            'game_eng' => GameEnum::from($this->getGameId())->eng(),
            'bo' => $this->getBestOf(),
            'num' => $this->getNum(),
            'duration' => $this->getDuration(),
            'has_picks' => $this->isHasPicks(),
            'has_bans' => $this->isHasBans(),
            'event' => [
                'id' => $this->getTournament()->id,
                'eng' => $this->getTournament()->eng,
                'title' => $this->getTournament()->title,
                'prize' => $this->getTournament()->prize,
                'has_icon' => $this->getTournament()->hasIcon()
            ],
            'teams' => [
                new TeamResource($this->getTeam1(), true),
                new TeamResource($this->getTeam2(), true),
            ],
            'gold' => $this->getGold(),
            'aggregated_events' => $this->getAggregatedEvents(),
            'events' => $this->getEvents()
        ];
    }
}
