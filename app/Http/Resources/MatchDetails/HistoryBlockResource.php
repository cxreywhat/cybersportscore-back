<?php

namespace App\Http\Resources\MatchDetails;

use App\Dto\MatchDetails\History\HistoryBlockItemDto;
use App\Dto\MatchDetails\History\TeamDto;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin HistoryBlockItemDto
 */
class HistoryBlockResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'match_id' => $this->getMatchId(),
            'event' => [
                'id' => $this->getTournamentId(),
                'title' => $this->getTournamentTitle(),
                'has_icon' => $this->hasLogo(),
            ],
            'date' => $this->getDate(),
            'bo' => $this->getBestOf(),
            'teams' => array_map(function (TeamDto $team) {
                return [
                    'id' => $team->id,
                    'score' => $team->score,
                    'title' => $team->title,
                    'short_title' => $team->shortTitle,
                    'has_icon' => $team->hasLogo,
                ];
            }, $this->getTeams())
        ];
    }
}
